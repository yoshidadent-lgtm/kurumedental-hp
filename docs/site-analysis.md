# kurume-dental.or.jp 構造分析（子テーマ spacious-child より）

分析元：`spacious-child.zip`（357ファイル、約8.5MB）。サイトへの直接接続は拒否されるため、テーマから読み取れた範囲の記録。
未入手：親テーマ `spacious`、エクスポートXML（本文・階層・メニュー）、プラグイン一覧、画面のHTML。

## 1. 技術構成
- WordPress + 親テーマ Spacious（ThemeGrill）+ 子テーマ（独自改修が大半）
- カスタムフィールド：ACF（`get_field` / `the_field`）
- カスタム投稿タイプ / タクソノミーの定義はテーマ外（プラグインかDB側）。XMLで確認が必要
- 外部：Googleフォント（Noto Sans JP、Heebo、Montserrat）、Google Maps埋め込み、Google検索（サイト内検索）、Font Awesome 4.7（CDN）、jQuery 1.8.2（http配信）
- スライダー等：bxSlider、Slick、Swiper、lightbox、wow.js ほか（`js/`、`css/`）

## 2. 共通レイアウト
- ヘッダー：ロゴ、所在地・電話（0942-32-7063）、リンク集ボタン、サイト内検索（Google）
- グローバルナビ（画像ボタン6つ）：歯科医師会のご紹介 / 訪問歯科診療のご案内 / 休日診療のご案内 / 健診事業のご案内 / 地域の歯医者さん / 会員のページ
- トップのみ：スライダー（5枚）＋キャッチ画像＋ボタン4つ
- フッター：ロゴ・住所・TEL/FAX、地図、リンク11件、コピーライト、ページトップ
- サイドバー：ページごとに切り替え（紹介系は文字メニュー、診療系は画像バナー5つ、会員系は専用メニュー）

## 3. ページ階層（URL）
- `/`（トップ）
- `/introduction/` → `introduction/`（会長挨拶）、`introduction_2/`（役員紹介）、`introduction_3/`（案内地図）、`introduction_4/`（入会案内）、`introduction_5/`（業務・財務資料）
- `/visiting_dental/`、`/holiday_clinic/`、`/assistant_course/`、`/event/`、`/link/`
- `/business_checkup/` → `business_checkup_1/` 〜 `_4/`（市区町村別の健診会場。タクソノミー `age_business_checkup_city`）
- `/local_dentist_top/`（地域の歯医者さん）→ タクソノミー `local_dentist`、`local_dentist_op1`〜`op5`（地域別の医院一覧。ACF：clinic_name / clinic_address / clinic_tel / clinic_remarks / clinic_detail）
- `/member/`（会員ログイン）→ `/members/` 配下：newsletter、monthly-report、member-event、council-news、member-archive、member-officer、member_plan、chairman_notebook

## 4. コンテンツの種類（カスタム投稿タイプ）
newsletter、monthly_report、member_event、member_airchive、council_news、finance、local_dentist_top ほか。
トップの更新情報は ACF のリピーター（`top-topics-update`）。

## 5. 移行上の重要点
1. **会員ページはパスワード保護の投稿（WordPress標準）**。静的サイト（GitHub Pages）では、サーバー側の認証ができない。会員向け資料（ニュースレター、月報、理事会便り等）を公開リポジトリに置くと、誰でも読める。**会員ページの扱いを先に決める必要がある**（例：別のパスワード保護サービス、非公開の仕組み、公開してよい資料だけ移す）。
2. 動的機能：サイト内検索（Google頼み）、会員ログイン、投稿の一覧・ページ送り。静的化で、生成済みHTMLへの置き換えが必要。
3. セキュリティ面の現状：WordPress本体の更新確認を無効化している設定あり（`functions.php`）。http配信のjQuery・CDNの混在。静的化と、https化・最新ライブラリへの更新で改善できる。
4. 旧URLの引き継ぎ：上記のURL階層と、アップロード画像のパス（`/wp-content/uploads/年/月/ファイル名`）を維持する。GitHub Pagesはサーバー側の転送ができないため、必要なURLは同じ位置にHTMLを置く。
5. 個人情報：受賞作品の画像のファイル名に児童の氏名が含まれる。公開リポジトリに置く前に、公開範囲を確認する。

## 6. 親テーマ spacious（v1.6.3）の分析
- 入手済み：153ファイル、約4.8MB（GPL v2以降のテーマ）。
- 子テーマが `header.php`、`footer.php`、ほとんどのページテンプレートを独自に差し替えているため、見た目の骨組みは**子テーマ側で決まっている**。親テーマから必要なのは、土台のCSS（`style.css`、約65KB）と、本文の出力（`content-page.php`：本文を `entry-content` で囲む）だけ。
- 親テーマのウィジェット、カスタマイザー設定、ブログ表示などの機能は、このサイトの表示には、ほぼ使われていない。
- 管理画面向けのファイル（`inc/admin`、`css/admin`、`tgm-plugin-activation`、`languages`、`gulpfile.js` など）は、静的サイトでは不要。
- 静的サイトに必要なもの：親の `style.css`、子の `style.css`（7,194行）、子の `images/`、`css/`、`js/`、`font-awesome/`。これで見た目の再現ができる。
- 未解決：各ページの本文、メニュー、医院一覧のデータはDB側にあり、XMLが必要。
