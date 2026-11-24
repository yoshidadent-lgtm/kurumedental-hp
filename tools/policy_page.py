#!/usr/bin/env python3
"""プライバシーポリシーのページ（privacy/index.html）を作る。文面は、このファイルの SECTIONS を書き換える。
下書き：理事会などで確認してから、公開する。［　］の部分は、公開前に埋める。"""
import json, pathlib, html, datetime
ROOT = pathlib.Path(__file__).resolve().parent.parent
site = json.loads((ROOT / 'data/site.json').read_text(encoding='utf-8'))
P = '../'
THEME = P + 'wp-content/themes/spacious-child'
import hashlib
ver = lambda f: hashlib.md5((ROOT / 'wp-content/themes/spacious-child/css' / f).read_bytes()).hexdigest()[:8]
frag = lambda n: (ROOT / 'templates' / n).read_text(encoding='utf-8').replace('{{R}}', P).replace('{{T}}', THEME).replace('{{YEAR}}', str(datetime.date.today().year))
robots = '<meta name="robots" content="noindex, nofollow">\n' if site.get('preview') else ''

ORG = '一般社団法人久留米歯科医師会'
SECTIONS = [
 ('基本方針', [
  f'{ORG}（以下「当会」）は、当会のホームページ（以下「本サイト」）をご利用くださる皆さまの個人情報を、大切に取り扱います。個人情報の保護に関する法律をはじめ、関係する法令を守り、以下の方針に従って、取り扱います。']),
 ('個人情報の取得について', [
  '本サイトには、お名前・ご住所・メールアドレスなどの個人情報を入力していただくフォームは、ありません。会員の方だけが見られるページも、ありません。',
  '電話・郵送・ご来会などで、お問い合わせをいただいた場合に、お名前・ご連絡先などを、おうかがいすることがあります。その情報は、お問い合わせへの対応のために、必要な範囲でのみ使います。']),
 ('アクセス情報・クッキーについて', [
  '本サイトでは、アクセス解析のサービスや、広告の仕組みは、使っていません。',
  'サーバーの管理上、アクセスの記録（アクセスした日時、IPアドレスなど）が、自動的に残る場合があります［要確認：サーバーの記録の有無・保存期間］。この記録は、障害への対応と、不正なアクセスの防止のためにだけ使い、個人を特定するためには使いません。']),
 ('外部サービスの利用について', [
  '次のページには、Google LLC が提供する「Googleマップ」を、埋め込んで表示しています。',
  'このとき、Googleに、ご利用の端末の情報やアクセスの情報が送られたり、Googleがクッキーなどを利用したりする場合があります。その取り扱いは、Googleのプライバシーポリシーに従います。',
  'ご利用のページ：案内地図、歯科助手講習会のご案内']),
 ('個人情報の第三者への提供について', [
  '当会は、法令に基づく場合など、正当な理由がある場合を除き、ご本人の同意なく、個人情報を第三者に提供しません。']),
 ('個人情報の管理について', [
  '当会は、取得した個人情報について、漏えい、滅失、き損、不正な利用を防ぐために、必要で適切な管理を行います。']),
 ('開示・訂正・削除のご請求について', [
  '当会が保有する、ご本人の個人情報について、開示・訂正・削除などのご請求があった場合は、ご本人であることを確認したうえで、法令に従って、対応します。下の「お問い合わせ窓口」に、ご連絡ください。']),
 ('外部サイトへのリンクについて', [
  '本サイトには、ほかの団体などのサイトへのリンクがあります。リンク先のサイトでの、個人情報の取り扱いや、掲載内容については、当会は、責任を負いません。']),
 ('著作権について', [
  '本サイトの文章・写真・イラストなどの著作権は、当会または、それぞれの権利者に属します。法令で認められる場合を除き、無断で、転載・複製・改変することは、できません。']),
 ('免責事項について', [
  '本サイトの内容は、できるだけ正確なものを掲載するよう努めていますが、その正確さや、最新であることを、保証するものではありません。本サイトの利用により生じた損害について、当会は、責任を負いません。診療や健診の最新の情報は、お電話などでも、ご確認ください。']),
 ('このポリシーの見直しについて', [
  '当会は、法令の改正や、本サイトの変更に合わせて、このポリシーを、予告なく見直すことがあります。変更した場合は、本サイトに掲載した時点から、効力を生じます。',
  '制定日：［　　年　月　日］']),
]
CONTACT = (f'{ORG}', '〒830-0013 福岡県久留米市櫛原町98', '0942-32-7063', '0942-32-7071')

def para(t):
    return '<p>%s</p>' % html.escape(t).replace('Googleマップ', 'Googleマップ')
body = ''
for i, (h, ps) in enumerate(SECTIONS, 1):
    body += f'<section class="pp-card">\n<h2 class="pp-h"><span class="pp-no">{i}</span>{html.escape(h)}</h2>\n<div class="pp-body">' + ''.join(para(p) for p in ps) + '</div>\n</section>\n'
contact = (f'<section class="pp-card pp-contact">\n<h2 class="pp-h"><span class="pp-no">{len(SECTIONS)+1}</span>お問い合わせ窓口</h2>\n<div class="pp-body">'
           f'<p><strong>{html.escape(CONTACT[0])}</strong><br>{html.escape(CONTACT[1])}<br>TEL <a href="tel:{CONTACT[2].replace("-", "")}">{CONTACT[2]}</a>　FAX {CONTACT[3]}</p></div>\n</section>\n')

page = f'''<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{html.escape(site['title'])}</title>
<meta name="description" content="久留米歯科医師会のホームページの、プライバシーポリシーです。">
<link rel="canonical" href="{site['origin']}/privacy/">
{robots}<link rel="icon" href="{P}favicon.ico" sizes="48x48">
<link rel="icon" href="{P}favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="{P}apple-touch-icon.png">
<link rel="stylesheet" href="{THEME}/css/chrome.css?v={ver('chrome.css')}">
<link rel="stylesheet" href="{THEME}/css/policy.css?v={ver('policy.css')}">
</head>
<body>
{frag('chrome_header.html')}

<main id="main" class="pp-main">
  <div class="wrap pp-wrap">
    <h1 class="pp-title">プライバシーポリシー<small>Privacy Policy</small></h1>
    <p class="pp-lead">当会のホームページを、安心してご利用いただくための、個人情報の取り扱いの方針です。</p>
{body}{contact}    <p class="pp-back"><a class="pp-btn" href="{P}">トップページへ戻る</a></p>
  </div>
</main>

{frag('chrome_footer.html')}
</body>
</html>
'''
(ROOT / 'privacy').mkdir(exist_ok=True)
(ROOT / 'privacy/index.html').write_text(page, encoding='utf-8')
print('作成: privacy/index.html（プライバシーポリシー）')
