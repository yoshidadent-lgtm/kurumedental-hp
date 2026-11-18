#!/usr/bin/env python3
"""新サイトの総点検。旧サイト（WordPress）が止まっても、リンク切れ・読み込み失敗が起きないかを調べる。
使い方: python3 -I tools/check_site.py
調べること: (1) 全ページのリンク・画像・CSS・JS・埋め込み、(2) CSSの中の画像・フォント、(3) JSの中の旧サイト依存、
(4) 旧サイトの全URLが、新サイトにあるか、(5) 外部サイトへの依存。"""
import re, json, sys, urllib.parse, collections, pathlib
from html.parser import HTMLParser
ROOT = pathlib.Path(__file__).resolve().parent.parent
SKIP_DIRS = {'.git', '.github', 'docs', 'tools', 'templates', 'data', 'deploy'}
OLD = re.compile(r'^https?://(?:www\.)?kurume-dental\.or\.jp(/.*)?$', re.I)

def pages():
    out = []
    for f in ROOT.rglob('*.html'):
        if f.relative_to(ROOT).parts[0] in SKIP_DIRS: continue
        out.append(f)
    return sorted(out)

class Collector(HTMLParser):
    def __init__(self): super().__init__(); self.refs = []; self.ids = set()
    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if a.get('id'): self.ids.add(a['id'])
        def add(kind, v):
            if v: self.refs.append((tag, kind, v.strip()))
        if tag == 'a': add('href', a.get('href'))
        elif tag == 'link':
            if (a.get('rel') or '') != 'canonical': add('href', a.get('href'))
        elif tag in ('script', 'img', 'iframe', 'source', 'input'): add('src', a.get('src'))
        if tag == 'img' and a.get('srcset'):
            for part in a['srcset'].split(','): add('srcset', part.strip().split(' ')[0])
        if tag == 'form': add('action', a.get('action'))
        if tag == 'meta' and (a.get('http-equiv') or '').lower() == 'refresh':
            m = re.search(r'url=(.+)', a.get('content') or '', re.I); add('refresh', m.group(1) if m else None)
        if a.get('style'):
            for u in re.findall(r'url\(["\']?([^"\')]+)', a['style']): add('style-url', u)

def resolve(src_file, ref):
    """ref を、リポジトリ内のファイルに対応づける。戻り値: (種類, パス or None)"""
    if re.match(r'^(mailto:|tel:|javascript:|data:|#)', ref): return ('skip', None)
    m = OLD.match(ref)
    if m: path = urllib.parse.unquote((m.group(1) or '/').split('?')[0].split('#')[0]); kind = 'old-absolute'
    elif re.match(r'^[a-z][a-z0-9+.-]*:', ref, re.I) or ref.startswith('//'): return ('external', ref)
    elif ref.startswith('/'): path = urllib.parse.unquote(ref.split('?')[0].split('#')[0]); kind = 'root-relative'
    else:
        base = src_file.parent
        target = (base / urllib.parse.unquote(ref.split('?')[0].split('#')[0])).resolve()
        try: path = '/' + str(target.relative_to(ROOT.resolve())); kind = 'relative'
        except ValueError: return ('outside', ref)
        if ref.split('?')[0].split('#')[0] == '': return ('skip', None)
    return (kind, path)

def exists(path):
    p = ROOT / path.lstrip('/')
    if path.endswith('/') or p.is_dir(): return (p / 'index.html').exists()
    return p.exists()

def main():
    problems = collections.defaultdict(list); external = collections.Counter(); old_abs = collections.Counter(); kdhs = 0; nrefs = 0
    all_ids = {}
    for f in pages():
        c = Collector(); c.feed(f.read_text(encoding='utf-8')); all_ids[f] = c.ids
    for f in pages():
        c = Collector(); c.feed(f.read_text(encoding='utf-8'))
        rel = str(f.relative_to(ROOT))
        for tag, kind, ref in c.refs:
            nrefs += 1
            k, path = resolve(f, ref)
            if k == 'skip': continue
            if k == 'external':
                external[urllib.parse.urlparse(ref).netloc] += 1; continue
            if k == 'old-absolute':
                if path.startswith('/kdhs'): kdhs += 1; continue
                old_abs[path] += 1
            if k == 'root-relative': problems['ルートからの指定（github.io の下層では動かない）'].append((rel, ref))
            if k == 'outside': problems['リポジトリの外を指している'].append((rel, ref)); continue
            if not exists(path): problems['リンク切れ（ファイルがない）'].append((rel, ref))
    # CSS の中
    css_problems = []
    for css in (ROOT / 'wp-content').rglob('*.css'):
        text = css.read_text(encoding='utf-8', errors='replace')
        for u in re.findall(r'url\(\s*["\']?([^"\')]+)', text) + re.findall(r'@import\s+(?:url\()?["\']?([^"\')\s;]+)', text):
            u = u.strip()
            if re.match(r'^(data:|#)', u): continue
            if re.match(r'^(https?:)?//', u):
                external[urllib.parse.urlparse(u if not u.startswith('//') else 'https:' + u).netloc] += 1; continue
            t = (css.parent / urllib.parse.unquote(u.split('?')[0].split('#')[0])).resolve()
            if not t.exists(): css_problems.append((str(css.relative_to(ROOT)), u))
    # JS の中
    js_hits = []
    for js in (ROOT / 'wp-content/themes/spacious-child/js').glob('*.js'):
        if js.name.endswith('.min.js') or 'vendor' in str(js): continue
        t = js.read_text(encoding='utf-8', errors='replace')
        for m in re.finditer(r'(admin-ajax|wp-json|wp-content|wp-admin|kurume-dental\.or\.jp|https?://[^\s"\']+)', t):
            js_hits.append((js.name, m.group(1)[:80]))
    # 旧サイトの全URLが、新サイトにあるか
    data = json.loads((ROOT / 'data/public-content.json').read_text(encoding='utf-8'))
    missing_urls = []
    for d in data:
        if d['type'] == 'local_dentist_top': continue
        path = (d['path'] + '/') if d['type'] == 'page' else d['link']
        if d['type'] == 'page' and d['slug'] == 'home': path = '/'
        if not exists(path): missing_urls.append((d['type'], path, d['title']))
    terms = json.loads((ROOT / 'data/terms.json').read_text(encoding='utf-8'))
    for tax, slug, name in terms:
        if tax.startswith('local_dentist') and '%' not in slug:
            p = f'/local_dentist_top/{tax}/{slug}/'
            if not exists(p): missing_urls.append(('term', p, name))
    # 結果
    print(f'検査したページ: {len(pages())} / 参照: {nrefs}')
    for k, v in problems.items():
        print(f'\n■ {k}: {len(v)}件'); [print('   ', a, '→', b) for a, b in v[:25]]
    print(f'\n■ CSS内の読み込み失敗: {len(css_problems)}件'); [print('   ', a, '→', b) for a, b in css_problems[:25]]
    print(f'\n■ 旧サイトの絶対URL（/kdhs/ 以外）: {sum(old_abs.values())}件'); [print('   ', p, n) for p, n in old_abs.most_common(15)]
    print(f'   （/kdhs/ へのリンク: {kdhs}件。別サイトとして、残る）')
    print(f'\n■ 旧サイトの全URLのうち、新サイトにないもの: {len(missing_urls)}件'); [print('   ', t, p, n) for t, p, n in missing_urls[:25]]
    print(f'\n■ JSの中の外部・旧サイトへの参照: {len(js_hits)}件'); [print('   ', a, b) for a, b in js_hits[:15]]
    print('\n■ 外部サイトへの依存（接続先ごと）:'); [print('   ', h, n) for h, n in external.most_common(25)]

main()
