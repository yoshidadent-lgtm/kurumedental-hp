#!/usr/bin/env python3
"""WordPressのエクスポートXMLから、公開してよい内容だけを取り出す。
使い方: python3 -I tools/extract.py <XMLのパス>
出力: data/public-content.json, data/acf.json, data/attachments.json
取り除くもの：会員向け・パスワード付き・下書き・非公開、メールアドレス。"""
import sys, json, re, subprocess, pathlib
import xml.etree.ElementTree as ET
ROOT = pathlib.Path(__file__).resolve().parent.parent
ns = {'wp': 'http://wordpress.org/export/1.2/', 'content': 'http://purl.org/rss/1.0/modules/content/', 'excerpt': 'http://wordpress.org/export/1.2/excerpt/'}
ch = ET.parse(sys.argv[1]).getroot().find('channel')
g = lambda it, t: (it.find('wp:' + t, ns).text or '') if it.find('wp:' + t, ns) is not None else ''
items = ch.findall('item')
byid = {g(i, 'post_id'): i for i in items}

# --- ACFの項目定義
raw = {}
fields = {}
for i in items:
    if g(i, 'post_type') == 'acf-field':
        raw[g(i, 'post_name')] = i.find('content:encoded', ns).text or ''
        fields[g(i, 'post_name')] = i.find('excerpt:encoded', ns).text or ''
un = json.loads(subprocess.run(['php', str(ROOT / 'tools/unserialize.php')], input=json.dumps(raw), capture_output=True, text=True, check=True).stdout)
bykey, byname = {}, {}
for key, d in un.items():
    if not d: continue
    e = {'name': fields[key], 'type': d.get('type'), 'choices': d.get('choices') or {}, 'return_format': d.get('return_format'), 'new_lines': d.get('new_lines')}
    bykey[key] = e; byname[e['name']] = e

# --- 添付ファイルの対応表
att = {g(i, 'post_id'): g(i, 'attachment_url') for i in items if g(i, 'post_type') == 'attachment'}
used = {}
def strip(u): return re.sub(r'^https?://[^/]+', '', u)

# --- 公開してよい投稿の選別
def ppath(it, allp):
    p = g(it, 'post_parent'); s = g(it, 'post_name')
    return (ppath(allp[p], allp) + '/' if p in allp else '/') + s
pages = {g(i, 'post_id'): i for i in items if g(i, 'post_type') == 'page'}
PUBLIC = {'page', 'post', 'event', 'finance', 'local_dentist_top'}
out = []
for it in items:
    pt, st = g(it, 'post_type'), g(it, 'status')
    if pt not in PUBLIC or st != 'publish' or g(it, 'post_password'): continue
    path = ppath(it, pages) if pt == 'page' else None
    if pt == 'page' and (path.startswith('/member') or re.match(r'^/page-\d+$', path) or path == '/'): continue
    meta = {}; mk = {}
    for m in it.findall('wp:postmeta', ns):
        k, v = g(m, 'meta_key'), g(m, 'meta_value')
        if k.startswith('_'): mk[k[1:]] = v
        if not k.startswith('_') or k == '_thumbnail_id': meta[k] = v
    for k in list(meta):
        f = bykey.get(mk.get(k, ''))
        if (f and f['type'] in ('file', 'image') and meta[k].isdigit() and meta[k] in att) or k == '_thumbnail_id' and meta[k] in att:
            used[meta[k]] = strip(att[meta[k]]); meta[k] = strip(att[meta[k]])
    meta = {k: v for k, v in meta.items() if k not in ('protect_children', 'spacious_page_layout', '_wp_page_template')}
    if pt == 'page' and g(it, 'post_name') == 'home':
        meta = {k: v for k, v in meta.items() if not k.startswith('top-topics-update')}
    link = strip(it.find('link').text or '')
    out.append(dict(type=pt, id=g(it, 'post_id'), slug=g(it, 'post_name'), title=it.find('title').text or '', date=g(it, 'post_date'),
                    path=path, link=link, menu_order=int(g(it, 'menu_order') or 0),
                    excerpt=it.find('excerpt:encoded', ns).text or '', content=it.find('content:encoded', ns).text or '',
                    terms=[[c.get('domain'), c.get('nicename')] for c in it.findall('category') if c.get('domain') not in ('category', 'post_tag')],
                    cats=[c.get('nicename') for c in it.findall('category') if c.get('domain') == 'category'], meta=meta))
terms = [[g(t, 'term_taxonomy'), g(t, 'term_slug'), g(t, 'term_name')] for t in ch.findall('wp:term', ns)]
(ROOT / 'data/public-content.json').write_text(json.dumps(out, ensure_ascii=False, indent=1), encoding='utf-8')
(ROOT / 'data/acf.json').write_text(json.dumps(byname, ensure_ascii=False, indent=1), encoding='utf-8')
(ROOT / 'data/attachments.json').write_text(json.dumps(used, ensure_ascii=False, indent=1), encoding='utf-8')
(ROOT / 'data/terms.json').write_text(json.dumps(terms, ensure_ascii=False, indent=1), encoding='utf-8')
s = json.dumps(out, ensure_ascii=False)
print('items', len(out), 'acf', len(byname), 'attachments used', len(used), 'emails', len(re.findall(r'[\w.+-]+@[\w-]+\.[\w.-]+', s)))
