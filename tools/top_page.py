#!/usr/bin/env python3
"""トップページ（index.html）を作る。改良案A（2026年11月）を採用したもの。
見た目は `wp-content/themes/spacious-child/css/top.css`。お知らせは、`data/public-content.json` の投稿から作る。"""
import json, html, pathlib, datetime
ROOT = pathlib.Path(__file__).resolve().parent.parent
data = json.loads((ROOT / 'data/public-content.json').read_text(encoding='utf-8'))
site = json.loads((ROOT / 'data/site.json').read_text(encoding='utf-8'))
P = ''                                   # ルート直下のページなので、リンクの前に付ける相対パスは、なし
IMG = P + 'wp-content/themes/spacious-child/images'
CSS = P + 'wp-content/themes/spacious-child/css/top.css'
YEAR = datetime.date.today().year
robots = '<meta name="robots" content="noindex, nofollow">\n' if site.get('preview') else ''
posts = sorted([d for d in data if d['type'] == 'post'], key=lambda d: d['date'], reverse=True)[:8]
news = ''.join('<li><time datetime="%s">%s年%d月%d日</time><a href="%spost-%s/">%s</a></li>\n'
               % (p['date'][:10], p['date'][:4], int(p['date'][5:7]), int(p['date'][8:10]), P, p['id'], html.escape(p['title'])) for p in posts)
svg = lambda body: '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>' % body
icon = {
 'cal': svg('<rect x="9" y="14" width="46" height="42" rx="6"/><path d="M9 26h46M21 8v10M43 8v10"/><path d="M22 38h6M36 38h6M22 47h6"/>'),
 'pin': svg('<path d="M32 58C20 44 14 34 14 26a18 18 0 0 1 36 0c0 8-6 18-18 32z"/><circle cx="32" cy="26" r="6.5"/>'),
 'check': svg('<rect x="13" y="10" width="38" height="48" rx="5"/><path d="M24 6h16v8H24zM22 30l5 5 9-10M22 46h20"/>'),
 'home': svg('<path d="M8 30L32 10l24 20M14 26v28h36V26"/><path d="M32 32v12M26 38h12"/>'),
}
quick = [
 ('holiday_clinic/', 'cal', '休日診療のご案内', '日曜・祝日の当番医をご案内します'),
 ('local_dentist_top/', 'pin', '地域の歯医者さん', '地域から、医院を探せます'),
 ('business_checkup/', 'check', '健診事業のご案内', '乳幼児から高齢者までの歯科健診'),
 ('visiting_dental/', 'home', '訪問歯科診療のご案内', 'ご自宅・施設への訪問診療'),
]
chips = [('op1', '1歳半・3歳児健診'), ('op2', 'フッ素塗布'), ('op3', '歯っぴー検診'), ('op4', '周術期ケア'), ('op5', '妊婦歯科健診')]
banners = [
 (P + 'introduction/introduction_4/', 'ishikai_banner.png', '久留米歯科医師会 入会のご案内', True),
 ('https://kurume-oral.com', 'koukuu-banner3.png', '口腔管理推進室', True),
 (P + 'event/', 'event_banner.jpg', 'イベント情報', False),
 (P + 'assistant_course/', 'kousyukai_banner.jpg', '歯科助手講習会のご案内', False),
 ('https://www.8020zaidan.or.jp/', 'zaidan_banner.jpg', '財団法人8020推進財団', False),
 ('https://kurume-dental.or.jp/kdhs/', 'school_banner.jpg', '久留米歯科衛生専門学校', False),
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
<link rel="stylesheet" href="{CSS}">
</head>
<body>
<a class="skip" href="#main">本文へ移動</a>
<header class="site-header">
  <div class="wrap head-row">
    <a class="brand" href="./"><img src="{IMG}/logo-2026.png" alt="久留米歯科医師会"></a>
    <div class="contact"><span>〒830-0013 福岡県久留米市櫛原町98</span><br><a class="tel" href="tel:0942327063">TEL 0942-32-7063</a></div>
  </div>
  <nav class="gnav" aria-label="メインメニュー">
    <div class="wrap">
      <input type="checkbox" id="nav-toggle"><label for="nav-toggle">メニューを開く</label>
      <ul>
        <li><a href="{P}introduction/">歯科医師会のご紹介</a></li>
        <li><a href="{P}visiting_dental/">訪問歯科診療</a></li>
        <li><a href="{P}holiday_clinic/">休日診療</a></li>
        <li><a href="{P}business_checkup/">健診事業</a></li>
        <li><a href="{P}local_dentist_top/">地域の歯医者さん</a></li>
      </ul>
    </div>
  </nav>
</header>

<main id="main">
  <section class="hero" aria-label="トップ画像">
    <img src="{IMG}/slider/img01.jpg" alt="久留米市の街並み">
    <div class="hero-text"><div class="wrap">
      <h1>久留米地域の皆様とともに</h1>
      <p>一般社団法人 久留米歯科医師会</p>
    </div></div>
  </section>

  <nav class="quick wrap" aria-label="主なご案内">
    <ul>
''' + ''.join(f'      <li><a href="{P}{u}">{icon[i]}<strong>{t}</strong><small>{s}</small></a></li>\n' for u, i, t, s in quick) + f'''    </ul>
  </nav>

  <section class="block wrap fest" aria-label="歯の健康フェスタ">
    <a href="{P}postar/"><img src="{IMG}/hanokenkoufesta.jpg" alt="歯の健康フェスタ ポスター展はこちら"></a>
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
''' + ''.join(f'      <li><a href="{P}local_dentist_top/local_dentist_{k}/">{t}</a></li>\n' for k, t in chips) + f'''    </ul>
  </section>

  <section class="block wrap" id="links">
    <h2>そのほかのご案内</h2>
    <ul class="banners">
''' + ''.join(f'      <li{" class=wide" if w else ""}><a href="{u}"><img src="{IMG}/{i}" alt="{t}" loading="lazy"></a></li>\n' for u, i, t, w in banners) + f'''    </ul>
  </section>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="foot">
      <div>
        <img src="{IMG}/logo-2026.png" alt="久留米歯科医師会">
        <p>〒830-0013 福岡県久留米市櫛原町98<br>TEL <a href="tel:0942327063">0942-32-7063</a>　FAX 0942-32-7071</p>
      </div>
      <ul>
        <li><a href="{P}introduction/">歯科医師会のご紹介</a></li>
        <li><a href="{P}visiting_dental/">訪問歯科診療のご案内</a></li>
        <li><a href="{P}holiday_clinic/">休日診療のご案内</a></li>
        <li><a href="{P}business_checkup/">健診事業のご案内</a></li>
        <li><a href="{P}local_dentist_top/">地域の歯医者さん</a></li>
        <li><a href="{P}assistant_course/">歯科助手講習会のご案内</a></li>
        <li><a href="{P}event/">イベント情報</a></li>
        <li><a href="{P}link/">リンク</a></li>
      </ul>
    </div>
    <p class="copy">Copyright &copy; {YEAR} Kurume Dental Association All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
'''
(ROOT / 'index.html').write_text(page, encoding='utf-8')
print('作成: index.html（新しいトップページ）')
