#!/usr/bin/env python3
"""静的サイトの生成。data/public-content.json と templates/ から HTML を作る。"""
import json, re, datetime, pathlib, html, sys
ROOT = pathlib.Path(__file__).resolve().parent.parent
data = json.loads((ROOT/'data/public-content.json').read_text(encoding='utf-8'))
site = json.loads((ROOT/'data/site.json').read_text(encoding='utf-8'))
import subprocess, shutil, urllib.parse

def php_render(spec):
    r = subprocess.run(['php', str(ROOT/'tools/render.php'), json.dumps(spec, ensure_ascii=False)], capture_output=True, text=True, check=True)
    return r.stdout

def write(path, content):
    f = ROOT / path
    f.parent.mkdir(parents=True, exist_ok=True)
    f.write_text(content, encoding='utf-8')

def build_all():
    # トップページは、改良案A（tools/top_page.py）で作る。それ以外のページは、旧テーマのテンプレートで作る。
    import subprocess as _sp
    _sp.run([sys.executable, str(ROOT / 'tools/top_page.py')], check=True)
    n = 1
    suffix = ''  # ページタイトルは、すべてのページで「久留米歯科医師会」
    for d in data:
        if d['type'] == 'page' and d['slug'] != 'home':
            path = d['path'].strip('/')
            write(path + '/index.html', php_render(dict(kind='page', id=d['id'], depth=path.count('/') + 1, title=site['title'], canon=path + '/'))); n += 1
        elif d['type'] in ('post', 'event', 'finance'):
            path = d['link'].strip('/')
            write(path + '/index.html', php_render(dict(kind='post', id=d['id'], depth=path.count('/') + 1, title=site['title'], canon=path + '/'))); n += 1
    write('event/index.html', php_render(dict(kind='archive', type='event', depth=1, title=site['title'], canon='event/'))); n += 1
    names = {(t[0], t[1]): t[2] for t in json.loads((ROOT/'data/terms.json').read_text(encoding='utf-8'))}
    for (tax, term), name in names.items():
        if not tax.startswith('local_dentist') or '%' in term: continue
        path = 'local_dentist_top/%s/%s' % (tax, term)
        write(path + '/index.html', php_render(dict(kind='tax', tax=tax, term=term, depth=3, title=site['title'], canon=path + '/'))); n += 1
    write('404.html', php_render(dict(kind='404', depth=0, title=site['title']))); n += 1
    # 旧URLから新URLへ移動する小さなページ（旧サイトの転送ルールのうち、会員向けを除く6件と、旧WordPressが自動で転送していた推測URL）
    import os
    redirects = {'business_checkup.html': 'business_checkup/', 'assistant_course.php': 'assistant_course/', 'event.php': 'event/',
                 'holiday_clinic.php': 'holiday_clinic/', 'local_dentist.php': 'local_dentist_top/', 'introduction.html': 'introduction/',
                 'business_checkup_1/index.html': 'business_checkup/business_checkup_1/', 'business_checkup_2/index.html': 'business_checkup/business_checkup_2/',
                 'business_checkup_3/index.html': 'business_checkup/business_checkup_3/', 'business_checkup_4/index.html': 'business_checkup/business_checkup_4/',
                 'introduction_2/index.html': 'introduction/introduction_2/', 'introduction_3/index.html': 'introduction/introduction_3/',
                 'introduction_4/index.html': 'introduction/introduction_4/', 'introduction_5/index.html': 'introduction/introduction_5/',
                 'introduction/introduction/index.html': 'introduction/'}
    for old, new in redirects.items():
        rel = os.path.relpath(new, os.path.dirname(old) or '.') + '/' if os.path.dirname(old) else new
        rel = rel if rel != './' else './'
        canon = site['origin'] + '/' + new
        write(old, '<!DOCTYPE html>\n<html lang="ja"><head><meta charset="utf-8"><title>ページが移動しました</title>'
                   '<link rel="canonical" href="%s"><meta http-equiv="refresh" content="0; url=%s"><meta name="robots" content="noindex">'
                   '</head><body><p>ページが移動しました。<a href="%s">こちら</a>をご覧ください。</p></body></html>\n' % (canon, rel, rel)); n += 1
    # 検索エンジン向け：サイトマップと robots.txt
    urls = ['']
    for d in data:
        if d['type'] == 'page' and d['slug'] != 'home': urls.append(d['path'].strip('/') + '/')
        elif d['type'] in ('post', 'event', 'finance'): urls.append(d['link'].strip('/') + '/')
    urls.append('event/')
    for (tax, term), name in names.items():
        if tax.startswith('local_dentist') and '%' not in term: urls.append('local_dentist_top/%s/%s/' % (tax, term))
    write('sitemap.xml', '<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n'
          + ''.join('<url><loc>%s/%s</loc></url>\n' % (site['origin'], u) for u in sorted(set(urls))) + '</urlset>\n')
    # 試験公開中（data/site.json の preview が true）は、検索エンジンに登録させない。本番へ切り替えるときに false にする。
    write('robots.txt', 'User-agent: *\nAllow: /\n' + ('' if site.get('preview') else 'Sitemap: %s/sitemap.xml\n' % site['origin']))
    write('.nojekyll', '')
    print('built', n, 'files')

if __name__ == '__main__':
    build_all()
