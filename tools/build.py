#!/usr/bin/env python3
"""静的サイトの生成。data/public-content.json と templates/ から HTML を作る。"""
import json, re, datetime, pathlib, html
ROOT = pathlib.Path(__file__).resolve().parent.parent
data = json.loads((ROOT/'data/public-content.json').read_text(encoding='utf-8'))
site = json.loads((ROOT/'data/site.json').read_text(encoding='utf-8'))
tpl = lambda n: (ROOT/'templates'/n).read_text(encoding='utf-8')
YEAR = str(datetime.date.today().year)

def render(depth, title, body_html, slider=False):
    R = '../' * depth
    T = R + 'wp-content/themes/spacious-child'
    page = tpl('header.html').replace('{{SLIDER}}', tpl('slider.html') if slider else '') + body_html + tpl('footer.html')
    return (page.replace('{{R}}', R).replace('{{T}}', T)
                .replace('{{TITLE}}', html.escape(title)).replace('{{YEAR}}', YEAR))

# 本文中の旧テーマ互換の置き換え（[hurl]、images/ のパス、誤ったリンクの補正）
def fix_content(c):
    c = c.replace('[hurl]introduction_4/', '[hurl]introduction/introduction_4/')
    c = c.replace('[hurl]', '{{R}}')
    c = c.replace('"images/', '"{{T}}/images/')
    return c

def news_list():
    posts = sorted([d for d in data if d['type'] == 'post'], key=lambda d: d['date'], reverse=True)[:15]
    items = []
    for p in posts:
        y, m, dd = p['date'][:10].split('-')
        items.append('<li class="getPost clearfix"><span class="day_date">%s年%d月%d日</span><p><a href="{{R}}post-%s/">%s</a></p></li>'
                     % (y, int(m), int(dd), p['id'], html.escape(p['title'])))
    return ''.join(items) if items else '<p>記事がありません。</p>'

def build_home():
    home = next(d for d in data if d['type'] == 'page' and d['slug'] == 'home')
    c = home['content']
    # 会員ページ更新のお知らせ（会員ページは公開しないため外す）
    c = re.sub(r'<div id="top_middle_members">.*?</div>\s*</div>', '', c, flags=re.S)
    c = c.replace('[getCategoryArticle]', news_list())
    c = fix_content(c)
    body = ('<div id="main" class="clearfix"><div class="inner-wrap"><div id="content" class="clearfix">'
            '<article id="post-%s" class="page"><div class="entry-content clearfix">%s</div></article>'
            '</div>' % (home['id'], c))
    # footer.html が .inner-wrap と #main を閉じる
    (ROOT/'index.html').write_text(render(0, site['title'], body, slider=True), encoding='utf-8')

import subprocess, shutil, urllib.parse

def php_render(spec):
    r = subprocess.run(['php', str(ROOT/'tools/render.php'), json.dumps(spec, ensure_ascii=False)], capture_output=True, text=True, check=True)
    return r.stdout

def write(path, content):
    f = ROOT / path
    f.parent.mkdir(parents=True, exist_ok=True)
    f.write_text(content, encoding='utf-8')

def build_all():
    build_home()
    n = 1
    suffix = ''  # ページタイトルは、すべてのページで「久留米歯科医師会」
    for d in data:
        if d['type'] == 'page' and d['slug'] != 'home':
            path = d['path'].strip('/')
            write(path + '/index.html', php_render(dict(kind='page', id=d['id'], depth=path.count('/') + 1, title=site['title']))); n += 1
        elif d['type'] in ('post', 'event'):
            path = d['link'].strip('/')
            write(path + '/index.html', php_render(dict(kind='post', id=d['id'], depth=path.count('/') + 1, title=site['title']))); n += 1
    write('event/index.html', php_render(dict(kind='archive', type='event', depth=1, title=site['title']))); n += 1
    names = {(t[0], t[1]): t[2] for t in json.loads((ROOT/'data/terms.json').read_text(encoding='utf-8'))}
    for (tax, term), name in names.items():
        if not tax.startswith('local_dentist') or '%' in term: continue
        path = 'local_dentist_top/%s/%s' % (tax, term)
        write(path + '/index.html', php_render(dict(kind='tax', tax=tax, term=term, depth=3, title=site['title']))); n += 1
    write('404.html', php_render(dict(kind='404', depth=0, title=site['title']))); n += 1
    # 旧URLから新URLへ移動する小さなページ（旧サイトの転送ルールのうち、会員向けを除く6件）
    redirects = {'business_checkup.html': 'business_checkup/', 'assistant_course.php': 'assistant_course/', 'event.php': 'event/',
                 'holiday_clinic.php': 'holiday_clinic/', 'local_dentist.php': 'local_dentist_top/', 'introduction.html': 'introduction/'}
    for old, new in redirects.items():
        write(old, '<!DOCTYPE html>\n<html lang="ja"><head><meta charset="utf-8"><title>ページが移動しました</title>'
                   '<link rel="canonical" href="%s"><meta http-equiv="refresh" content="0; url=%s"><meta name="robots" content="noindex">'
                   '</head><body><p>ページが移動しました。<a href="%s">こちら</a>をご覧ください。</p></body></html>\n' % (new, new, new)); n += 1
    write('.nojekyll', '')
    print('built', n, 'files')

if __name__ == '__main__':
    build_all()
