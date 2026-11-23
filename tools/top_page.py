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
banners = [
 (P + 'introduction/introduction_4/', 'ishikai_banner.png', '久留米歯科医師会 入会のご案内', True),
 ('https://kurume-oral.com', 'koukuu-banner3.png', '口腔管理推進室', True),
 (P + 'event/', 'event_banner.jpg', 'イベント情報', False),
 (P + 'assistant_course/', 'kousyukai_banner.jpg', '歯科助手講習会のご案内', False),
 ('https://www.8020zaidan.or.jp/', 'zaidan_banner.jpg', '財団法人8020推進財団', False),
 ('https://kurume-dental.or.jp/kdhs/', 'school_banner.jpg', '久留米歯科衛生専門学校', False),
]
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
''' + ''.join(f'      <li{" class=wide" if w else ""}><a href="{u}"><img src="{IMG}/{i}" alt="{t}" loading="lazy"></a></li>\n' for u, i, t, w in banners) + f'''    </ul>
  </section>
</main>

{CHROME_FOOTER}
</body>
</html>
'''
(ROOT / 'index.html').write_text(page, encoding='utf-8')
print('作成: index.html（新しいトップページ）')
