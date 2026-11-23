#!/usr/bin/env python3
"""トップページ（index.html）を作る。改良案A（2026年11月）を採用したもの。
見た目は `wp-content/themes/spacious-child/css/top.css`。お知らせは、`data/public-content.json` の投稿から作る。"""
import json, html, pathlib, datetime
ROOT = pathlib.Path(__file__).resolve().parent.parent
data = json.loads((ROOT / 'data/public-content.json').read_text(encoding='utf-8'))
site = json.loads((ROOT / 'data/site.json').read_text(encoding='utf-8'))
P = ''                                   # ルート直下のページなので、リンクの前に付ける相対パスは、なし
IMG = P + 'wp-content/themes/spacious-child/images'
THEME = P + 'wp-content/themes/spacious-child'
import hashlib
ver = lambda f: hashlib.md5((ROOT / THEME / 'css' / f).read_bytes()).hexdigest()[:8]   # 古い表示が残らないよう、CSSの内容から版番号を付ける
CSS = THEME + '/css/top.css?v=' + ver('top.css')
CHROME_CSS = THEME + '/css/chrome.css?v=' + ver('chrome.css')
CARDS_CSS = THEME + '/css/cards.css?v=' + ver('cards.css')
frag = lambda n: (ROOT / 'templates' / n).read_text(encoding='utf-8').replace('{{R}}', P).replace('{{T}}', THEME).replace('{{YEAR}}', str(datetime.date.today().year))
CHROME_HEADER = frag('chrome_header.html')
CHROME_FOOTER = frag('chrome_footer.html')
YEAR = datetime.date.today().year
robots = '<meta name="robots" content="noindex, nofollow">\n' if site.get('preview') else ''
posts = sorted([d for d in data if d['type'] == 'post' and d['date'][:4] >= '2026'], key=lambda d: d['date'], reverse=True)[:8]   # お知らせは、2026年以降のみ（ユーザー指示）
news = ''.join('<li><time datetime="%s">%s年%d月%d日</time><a href="%spost-%s/">%s</a></li>\n'
               % (p['date'][:10], p['date'][:4], int(p['date'][5:7]), int(p['date'][8:10]), P, p['id'], html.escape(p['title'])) for p in posts)
svg = lambda body: '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>' % body
icon = {
 'cal': svg('<rect x="9" y="14" width="46" height="42" rx="6"/><path d="M9 26h46M21 8v10M43 8v10"/><path d="M22 38h6M36 38h6M22 47h6"/>'),
 'pin': svg('<path d="M32 58C20 44 14 34 14 26a18 18 0 0 1 36 0c0 8-6 18-18 32z"/><circle cx="32" cy="26" r="6.5"/>'),
 'check': svg('<rect x="13" y="10" width="38" height="48" rx="5"/><path d="M24 6h16v8H24zM22 30l5 5 9-10M22 46h20"/>'),
 'home': svg('<path d="M8 30L32 10l24 20M14 26v28h36V26"/><path d="M32 32v12M26 38h12"/>'),
}
quick = [   # <wbr> は、狭い画面で改行してよい、自然な区切りの位置。最後は、カードの色の名前（top.css の q-…）
 ('holiday_clinic/', 'cal', '休日診療の<wbr>ご案内', '日曜・祝日の<wbr>当番医を<wbr>ご案内します', 'holiday'),
 ('local_dentist_top/', 'pin', '地域の<wbr>歯医者さん', '地域から、<wbr>医院を<wbr>探せます', 'clinic'),
 ('business_checkup/', 'check', '健診事業の<wbr>ご案内', '乳幼児から<wbr>高齢者までの<wbr>歯科健診', 'checkup'),
 ('visiting_dental/', 'home', '訪問歯科診療の<wbr>ご案内', 'ご自宅・施設への<wbr>訪問診療', 'visit'),
]
chips = [('op1', '1歳半・<wbr>3歳児健診'), ('op2', 'フッ素塗布'), ('op3', '歯っぴー<wbr>検診'), ('op4', '周術期ケア'), ('op5', '妊婦歯科<wbr>健診')]

def woman(hair, skin, outfit, collar, kind):   # 女性のイラスト（頭が大きく、目が大きい、かわいい絵柄）
    hl = {'event': '#5a4040', 'assist': '#a2693f', 'school': '#3a3a52'}[kind]   # 髪のつや
    back = {'event': f'<circle cx="60" cy="14" r="11" fill="{hair}"/><path d="M24 52c-10 8-10 28 2 34 8-4 8-22 4-34zM96 52c10 8 10 28-2 34-8-4-8-22-4-34z" fill="{hair}"/>',
            'assist': f'<path d="M26 56c-4 20 0 34 12 38V58zM94 56c4 20 0 34-12 38V58z" fill="{hair}"/>',
            'school': f'<path d="M24 54c-8 30-2 54 14 58V56zM96 54c8 30 2 54-14 58V56z" fill="{hair}"/>'}[kind]
    bangs = {'event': f'<path d="M29 56c-3-26 10-40 31-40s34 14 31 40c-6-6-9-16-10-22-10 8-30 14-52 22z" fill="{hair}"/>',
             'assist': f'<path d="M28 58c-4-28 10-42 32-42s36 14 32 42c-8-4-12-14-12-22-8 8-30 18-52 22z" fill="{hair}"/>',
             'school': f'<path d="M29 58c-3-28 10-42 31-42s34 14 31 42c-5-8-8-16-8-24-10 10-30 20-54 24z" fill="{hair}"/>'}[kind]
    shine = f'<path d="M42 28c6-5 16-6 24-3" fill="none" stroke="{hl}" stroke-width="4" stroke-linecap="round"/>'
    extra = {'event': '<g transform="rotate(16 100 98)"><rect x="96" y="66" width="6" height="40" rx="3" fill="#fff" stroke="#9fb4c8" stroke-width="1.5"/><rect x="92" y="48" width="14" height="22" rx="4" fill="#6ec1f0"/><path d="M95 52h8M95 57h8M95 62h8" stroke="#fff" stroke-width="2"/></g><path d="M16 30l2.5 6 6 2.5-6 2.5-2.5 6-2.5-6-6-2.5 6-2.5z" fill="#ffd54a"/><path d="M104 22l1.8 4.2 4.2 1.8-4.2 1.8-1.8 4.2-1.8-4.2-4.2-1.8 4.2-1.8z" fill="#ffd54a"/>',
             'assist': '<g transform="translate(86 30)"><circle cx="0" cy="-6" r="5" fill="#ff8fb1"/><circle cx="6" cy="0" r="5" fill="#ff8fb1"/><circle cx="0" cy="6" r="5" fill="#ff8fb1"/><circle cx="-6" cy="0" r="5" fill="#ff8fb1"/><circle cx="0" cy="0" r="4" fill="#ffd54a"/></g><path d="M14 40l2 4.800 4.800 2-4.800 2-2 4.800-2-4.800-4.800-2 4.800-2z" fill="#ffd54a"/>',
             'school': '<g transform="translate(84 30)"><path d="M0 0L-16-10v20zM0 0l16-10v20z" fill="#e8537f"/><circle r="4" fill="#c93566"/></g><path d="M52 96l8 6 8-6-4 12h-8z" fill="#e8537f"/>'}[kind]
    eye = lambda cx: (f'<ellipse cx="{cx}" cy="62" rx="4.6" ry="6" fill="#3a2838"/><circle cx="{cx-1.6}" cy="59.5" r="2.1" fill="#fff"/><circle cx="{cx+1.6}" cy="64.5" r="1" fill="#fff"/>'
                      f'<path d="M{cx-6} 57q6-5 12 0" fill="none" stroke="#3a2838" stroke-width="1.6" stroke-linecap="round"/>')
    return (f'<svg viewBox="0 0 120 120" aria-hidden="true">{back}'
            f'<path d="M12 120c2-18 16-26 48-26s46 8 48 26z" fill="{outfit}"/>'
            f'<path d="M48 94l12 14 12-14z" fill="{collar}"/><rect x="53" y="82" width="14" height="14" rx="6" fill="{skin}"/>'
            f'<ellipse cx="60" cy="58" rx="31" ry="29" fill="{skin}"/>{bangs}{shine}{eye(47)}{eye(73)}'
            f'<ellipse cx="38" cy="71" rx="5.5" ry="3.4" fill="#ff9fb4" opacity=".75"/><ellipse cx="82" cy="71" rx="5.5" ry="3.4" fill="#ff9fb4" opacity=".75"/>'
            f'<path d="M54 71q6 9 12 0z" fill="#d9455f"/><path d="M57 74.500q3 2.500 6 0" fill="none" stroke="#ff8fa6" stroke-width="2" stroke-linecap="round"/>{extra}</svg>')
girls = {'event': woman('#3b2a2a', '#ffe0cf', '#bfe9df', '#fff', 'event'),
         'assist': woman('#7a4a2a', '#ffe3d2', '#ffd3dc', '#fff', 'assist'),
         'school': '<img src="{IMG}/school-girl.png" alt="" width="121" height="140" loading="lazy">'}   # 学校：ユーザー提供のイラスト（紺の制服に変更）
def banner_html(u, i, t, w, c='', pre=P, img=IMG):
    if i.startswith('card:'):
        k = i[5:]
        return f'      <li class="bn-{k}"><a class="bn-card" href="{u}"><strong>{t}</strong>{girls[k].replace("{IMG}", img)}</a></li>\n'
    return f'      <li class="{"wide" if w else "plain"} bn-{c}"><a href="{u}"><img src="{img}/{i}" alt="{t}" loading="lazy"></a></li>\n'
banners = [   # (リンク先, 画像かカード, 題名, 横に2枚分か, 色の名前)
 (P + 'introduction/introduction_4/', 'ishikai_banner.png', '久留米歯科医師会 入会のご案内', True, 'join'),
 ('https://kurume-oral.com', 'koukuu-banner3.png', '口腔管理推進室', True, 'oral'),
 (P + 'event/', 'card:event', 'イベント<wbr>情報', False, ''),
 (P + 'assistant_course/', 'card:assist', '歯科助手<wbr>講習会の<wbr>ご案内', False, ''),
 ('https://www.8020zaidan.or.jp/', 'zaidan_banner.jpg', '財団法人8020推進財団', False, 'zaidan'),
 ('https://kurume-dental.or.jp/kdhs/', 'card:school', '久留米歯科<wbr>衛生専門学校', False, ''),
]
# 下のページの右の列：イベント、学校、講習会、8020、口腔管理推進室（トップと同じカード）。{{R}}・{{T}} は、render.php が、ページの深さに合わせて置き換える
_side = [('{{R}}event/', 'card:event', 'イベント<wbr>情報', False, ''),
         ('https://kurume-dental.or.jp/kdhs/', 'card:school', '久留米歯科<wbr>衛生専門学校', False, ''),
         ('{{R}}assistant_course/', 'card:assist', '歯科助手<wbr>講習会の<wbr>ご案内', False, ''),
         ('https://www.8020zaidan.or.jp/', 'zaidan_banner.jpg', '財団法人8020推進財団', False, 'zaidan'),
         ('https://kurume-oral.com/', 'koukuu-banner3.png', '口腔管理推進室', False, 'oral')]
(ROOT / 'templates/side_cards.html').write_text('<ul class="banners side-cards">\n' + ''.join(banner_html(*b, img='{{T}}/images') for b in _side) + '</ul>\n', encoding='utf-8')
slides = [   # (ファイル名, 写真の説明, 幅, 高さ, 調整用の名前)　並べた順に、切り替わる
 ('img07.jpg', '高い所から見た街並み', 1600, 1200, 'city'),
 ('img02.jpg', '満開の桜と、久留米歯科医師会館', 875, 410, 'blossom'),
 ('img03.jpg', '久留米歯科医師会館の入口', 875, 410, 'entrance'),
 ('img06.jpg', '満開の桜並木の通り', 1125, 1500, 'sakura'),
 ('img05.jpg', '口腔保健センターの入口', 875, 410, 'center'),
]
description = '久留米歯科医師会の公式ホームページです。休日診療の当番医、地域の歯医者さん、健診事業、訪問歯科診療などをご案内します。'
page = f'''<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{html.escape(site['title'])}</title>
<meta name="description" content="{description}">
<link rel="canonical" href="{site['origin']}/">
{robots}<link rel="icon" href="{P}favicon.ico" sizes="48x48">
<link rel="icon" href="{P}favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="{P}apple-touch-icon.png">
<link rel="stylesheet" href="{CHROME_CSS}">
<link rel="stylesheet" href="{CSS}">
<link rel="stylesheet" href="{CARDS_CSS}">
</head>
<body>
{CHROME_HEADER}

<main id="main">
  <section class="hero" aria-label="写真のスライドショー">
    <input type="checkbox" id="hero-pause" class="hero-pause-input">
    <label for="hero-pause" class="hero-pause"><span class="sr-only">スライドショーの一時停止と再開</span><span class="pause-icon" aria-hidden="true"></span></label>
    <ul class="slides">
''' + ''.join(f'      <li class="slide slide-{k}"><img src="{IMG}/slider/{f}" alt="{t}" width="{w}" height="{h}"></li>\n' for f, t, w, h, k in slides) + f'''    </ul>
    <div class="hero-text"><div class="wrap"><div class="hero-card">
      <h1>久留米地域の皆様とともに</h1>
      <p>一般社団法人 久留米歯科医師会</p>
    </div></div></div>
  </section>

  <nav class="quick wrap" aria-label="主なご案内">
    <ul>
''' + ''.join(f'      <li><a class="q-{k}" href="{P}{u}">{icon[i]}<strong>{t}</strong><small>{s}</small></a></li>\n' for u, i, t, s, k in quick) + f'''    </ul>
  </nav>

  <section class="block wrap fest" aria-label="歯の健康フェスタ">
    <a class="fest-card" href="{P}postar/">
      <span class="fest-bubbles" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span>
      <span class="fest-text">
        <small>毎年恒例の、<wbr>歯の健康イベント</small>
        <strong>歯の<wbr>健康フェスタ</strong>
        <span class="fest-sub">ポスター展は<wbr>こちら</span>
      </span>
      <span class="fest-go" aria-hidden="true">見る<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg></span>
      <svg class="fest-tooth" viewBox="0 0 100 110" aria-hidden="true"><path d="M50 12c-9-8-30-8-35 10-4 15 3 27 7 42 3 11 4 38 14 38 8 0 7-24 14-24s6 24 14 24c10 0 11-27 14-38 4-15 11-27 7-42-5-18-26-18-35-10z" fill="#fff" stroke="#fff" stroke-width="4" stroke-linejoin="round"/><circle cx="38" cy="42" r="4.5" fill="#0f2a5a"/><circle cx="62" cy="42" r="4.5" fill="#0f2a5a"/><path d="M40 55q10 10 20 0" fill="none" stroke="#0f2a5a" stroke-width="4" stroke-linecap="round"/><circle cx="30" cy="52" r="5" fill="#ffb3c7" opacity=".8"/><circle cx="70" cy="52" r="5" fill="#ffb3c7" opacity=".8"/></svg>
    </a>
  </section>

  <section class="block wrap" id="news">
    <h2>お知らせ・トピックス</h2>
    <ul class="news">
{news}    </ul>
    <p class="more"><a class="btn" href="{P}event/">イベント情報の一覧</a></p>
  </section>

  <section class="block wrap" id="clinics">
    <h2>受付歯科医院を探す</h2>
    <p class="lead">事業ごとに、受付をしている歯科医院を、地域別にご覧いただけます。</p>
    <ul class="chips">
''' + ''.join(f'      <li><a class="c-{k}" href="{P}local_dentist_top/local_dentist_{k}/">{t}</a></li>\n' for k, t in chips) + f'''    </ul>
  </section>

  <section class="block wrap" id="links">
    <h2>そのほかのご案内</h2>
    <ul class="banners">
''' + ''.join(banner_html(*b) for b in banners) + f'''    </ul>
  </section>
</main>

{CHROME_FOOTER}
</body>
</html>
'''
(ROOT / 'index.html').write_text(page, encoding='utf-8')
print('作成: index.html（新しいトップページ）')
