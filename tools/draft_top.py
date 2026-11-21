#!/usr/bin/env python3
"""トップページの改良案Aを作る（たたき台）。現行の内容を保ち、読みやすさとスマホ表示を改善する案。"""
import json, html, pathlib
ROOT = pathlib.Path(__file__).resolve().parent.parent
data = json.loads((ROOT / 'data/public-content.json').read_text(encoding='utf-8'))
IMG = '../../wp-content/themes/spacious-child/images'
posts = sorted([d for d in data if d['type'] == 'post'], key=lambda d: d['date'], reverse=True)[:8]
news = ''.join('<li><time datetime="%s">%s年%d月%d日</time><a href="../../post-%s/">%s</a></li>\n'
               % (p['date'][:10], p['date'][:4], int(p['date'][5:7]), int(p['date'][8:10]), p['id'], html.escape(p['title'])) for p in posts)
icon = {
 'cal': '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="14" width="46" height="42" rx="6"/><path d="M9 26h46M21 8v10M43 8v10"/><path d="M22 38h6M36 38h6M22 47h6"/></svg>',
 'pin': '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M32 58C20 44 14 34 14 26a18 18 0 0 1 36 0c0 8-6 18-18 32z"/><circle cx="32" cy="26" r="6.5"/></svg>',
 'check': '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="13" y="10" width="38" height="48" rx="5"/><path d="M24 6h16v8H24zM22 30l5 5 9-10M22 46h20"/></svg>',
 'home': '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 30L32 10l24 20M14 26v28h36V26"/><path d="M32 32v12M26 38h12"/></svg>',
}
quick = [
 ('../../holiday_clinic/', 'cal', '休日診療のご案内', '日曜・祝日の当番医をご案内します'),
 ('../../local_dentist_top/', 'pin', '地域の歯医者さん', '地域から、医院を探せます'),
 ('../../business_checkup/', 'check', '健診事業のご案内', '乳幼児から高齢者までの歯科健診'),
 ('../../visiting_dental/', 'home', '訪問歯科診療のご案内', 'ご自宅・施設への訪問診療'),
]
chips = [('op1', '1歳半・3歳児健診'), ('op2', 'フッ素塗布'), ('op3', '歯っぴー検診'), ('op4', '周術期ケア'), ('op5', '妊婦歯科健診')]
banners = [
 ('../../introduction/introduction_4/', 'ishikai_banner.png', '久留米歯科医師会 入会のご案内'),
 ('https://kurume-oral.com', 'koukuu-banner3.png', '口腔管理推進室'),
 ('../../event/', 'event_banner.jpg', 'イベント情報'),
 ('../../assistant_course/', 'kousyukai_banner.jpg', '歯科助手講習会のご案内'),
 ('https://www.8020zaidan.or.jp/', 'zaidan_banner.jpg', '財団法人8020推進財団'),
 ('https://kurume-dental.or.jp/kdhs/', 'school_banner.jpg', '久留米歯科衛生専門学校'),
]
page = f'''<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>久留米歯科医師会（トップページ 改良案A）</title>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="../../favicon.ico" sizes="48x48">
<link rel="icon" href="../../favicon.svg" type="image/svg+xml">
<link rel="stylesheet" href="style.css">
</head>
<body>
<a class="skip" href="#main">本文へ移動</a>
<header class="site-header">
  <div class="wrap head-row">
    <a class="brand" href="../../"><img src="{IMG}/logo.png" alt="久留米歯科医師会"></a>
    <div class="contact"><span>〒830-0013 福岡県久留米市櫛原町98</span><br><a class="tel" href="tel:0942327063">TEL 0942-32-7063</a></div>
  </div>
  <nav class="gnav" aria-label="メインメニュー">
    <div class="wrap">
      <input type="checkbox" id="nav-toggle"><label for="nav-toggle">メニューを開く</label>
      <ul>
        <li><a href="../../introduction/">歯科医師会のご紹介</a></li>
        <li><a href="../../visiting_dental/">訪問歯科診療</a></li>
        <li><a href="../../holiday_clinic/">休日診療</a></li>
        <li><a href="../../business_checkup/">健診事業</a></li>
        <li><a href="../../local_dentist_top/">地域の歯医者さん</a></li>
      </ul>
    </div>
  </nav>
</header>

<main id="main">
  <section class="hero" aria-label="トップ画像">
    <img src="{IMG}/slider/img01.jpg" alt="久留米歯科医師会館の外観">
    <div class="hero-text"><div class="wrap">
      <h1>久留米地域の皆様とともに</h1>
      <p>一般社団法人 久留米歯科医師会</p>
    </div></div>
  </section>

  <nav class="quick wrap" aria-label="主なご案内">
    <ul>
''' + ''.join(f'      <li><a href="{u}">{icon[i]}<strong>{t}</strong><small>{s}</small></a></li>\n' for u, i, t, s in quick) + f'''    </ul>
  </nav>

  <section class="block wrap fest" aria-label="歯の健康フェスタ">
    <a href="../../postar/"><img src="{IMG}/hanokenkoufesta.jpg" alt="歯の健康フェスタ ポスター展はこちら"></a>
  </section>

  <section class="block wrap" id="news">
    <h2>お知らせ・トピックス</h2>
    <ul class="news">
{news}    </ul>
    <p class="more"><a class="btn" href="../../event/">イベント情報の一覧</a></p>
  </section>

  <section class="block wrap" id="clinics">
    <h2>受付歯科医院を探す</h2>
    <p class="lead">事業ごとに、受付をしている歯科医院を、地域別にご覧いただけます。</p>
    <ul class="chips">
''' + ''.join(f'      <li><a href="../../local_dentist_top/local_dentist_{k}/">{t}</a></li>\n' for k, t in chips) + f'''    </ul>
  </section>

  <section class="block wrap" id="links">
    <h2>そのほかのご案内</h2>
    <ul class="banners">
''' + ''.join(f'      <li{" class=\"wide\"" if i in ("ishikai_banner.png", "koukuu-banner3.png") else ""}><a href="{u}"><img src="{IMG}/{i}" alt="{t}" loading="lazy"></a></li>\n' for u, i, t in banners) + f'''    </ul>
  </section>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="foot">
      <div>
        <img src="{IMG}/logo.png" alt="久留米歯科医師会">
        <p>〒830-0013 福岡県久留米市櫛原町98<br>TEL 0942-32-7063　FAX 0942-32-7071</p>
      </div>
      <ul>
        <li><a href="../../introduction/">歯科医師会のご紹介</a></li>
        <li><a href="../../visiting_dental/">訪問歯科診療のご案内</a></li>
        <li><a href="../../holiday_clinic/">休日診療のご案内</a></li>
        <li><a href="../../business_checkup/">健診事業のご案内</a></li>
        <li><a href="../../local_dentist_top/">地域の歯医者さん</a></li>
        <li><a href="../../assistant_course/">歯科助手講習会のご案内</a></li>
        <li><a href="../../event/">イベント情報</a></li>
        <li><a href="../../link/">リンク</a></li>
      </ul>
    </div>
    <p class="copy">Copyright &copy; 2026 Kurume City Dental Association All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
'''
(ROOT / 'draft/top-a/index.html').write_text(page, encoding='utf-8')
print('作成:', 'draft/top-a/index.html')
