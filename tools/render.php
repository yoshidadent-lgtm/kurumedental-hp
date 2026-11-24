<?php
// 旧テーマ（spacious-child）のテンプレートを、最小限のWordPress互換関数で動かして、HTMLを作る。
// 使い方: php tools/render.php '<JSON>'
//   {"kind":"page|post|tax|archive|404","id":"ID","tax":"","term":"","type":"","depth":N,"title":"…"}
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
mb_internal_encoding('UTF-8');
$ROOT = dirname(__DIR__);
$spec = json_decode($argv[1], true);
$R = str_repeat('../', $spec['depth']);
$T = $R . 'wp-content/themes/spacious-child';
$SITE = json_decode(file_get_contents("$ROOT/data/site.json"), true);
$ACF = json_decode(file_get_contents("$ROOT/data/acf.json"), true);
$DATA = array_map(fn($d) => (object)$d, json_decode(file_get_contents("$ROOT/data/public-content.json"), true));
$wp_autop = true; $loop_i = 0; $row_stack = []; $posts = []; $post = null;

// ---- 現在のリクエスト
$q = ['kind' => $spec['kind'], 'tax' => $spec['tax'] ?? '', 'term' => $spec['term'] ?? ''];
function by_type($t) { global $DATA; return array_values(array_filter($DATA, fn($d) => $d->type === $t)); }
function sort_date_desc(&$a) { usort($a, fn($x, $y) => strcmp($y->date, $x->date)); }
if ($q['kind'] === 'page' || $q['kind'] === 'post') {
    foreach ($DATA as $d) if ($d->id === (string)$spec['id']) $posts = [$d];
} elseif ($q['kind'] === 'tax') {
    foreach (by_type('local_dentist_top') as $d)
        foreach ($d->terms as $t) if ($t[0] === $q['tax'] && $t[1] === $q['term']) { $posts[] = $d; break; }
    usort($posts, fn($x, $y) => ($x->menu_order <=> $y->menu_order) ?: strcmp($y->date, $x->date));
} elseif ($q['kind'] === 'archive') {
    $posts = by_type($spec['type']); sort_date_desc($posts);
    // イベント一覧は、2026年以降だけを載せる（ユーザー指示）。各イベントの記事ページは、残してある
    if ($spec['type'] === 'event') $posts = array_values(array_filter($posts, fn($d) => substr($d->date, 0, 4) >= '2026'));
}

if (in_array($q['kind'], ['page', 'post'])) $post = $posts[0];  // 単体ページでは、最初から現在の投稿が決まっている

// ---- 文字列の整形
function rel_url($s) {  // サイト内の画像・資料のURLを、相対パスにする
    global $R;
    $s = preg_replace('#https?://(?:www\.)?kurume-dental\.or\.jp/wp-content/#', $R . 'wp-content/', $s);
    // 本文の中の、このサイト自身へのリンクも、相対にする（別サイト /kdhs/ は、そのまま）
    $s = preg_replace('#(["\'])https?://(?:www\.)?kurume-dental\.or\.jp/(?!kdhs)#', '$1' . $R, $s);
    return $s;
}
function wpautop($text, $br = true) {
    if (trim($text) === '') return '';
    $text .= "\n";
    $text = preg_replace('|<br\s*/?>\s*<br\s*/?>|', "\n\n", $text);
    $all = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
    $text = preg_replace('!(<' . $all . '[\s/>])!', "\n\n$1", $text);
    $text = preg_replace('!(</' . $all . '>)!', "$1\n\n", $text);
    $text = str_replace(["\r\n", "\r"], "\n", $text);
    $text = preg_replace_callback('/<[^>]*>/s', fn($m) => str_replace("\n", ' ', $m[0]), $text);
    $text = preg_replace("/\n\n+/", "\n\n", $text);
    $parts = preg_split('/\n\s*\n/', $text, -1, PREG_SPLIT_NO_EMPTY);
    $text = '';
    foreach ($parts as $p) $text .= '<p>' . trim($p, "\n") . "</p>\n";
    $text = preg_replace('|<p>\s*</p>|', '', $text);
    $text = preg_replace('!<p>([^<]+)</(div|address|form)>!', '<p>$1</p></$2>', $text);
    $text = preg_replace('!<p>\s*(</?' . $all . '[^>]*>)\s*</p>!', '$1', $text);
    $text = preg_replace('|<p>(<li.+?)</p>|', '$1', $text);
    $text = preg_replace('|<p><blockquote([^>]*)>|i', '<blockquote$1><p>', $text);
    $text = str_replace('</blockquote></p>', '</p></blockquote>', $text);
    $text = preg_replace('!<p>\s*(</?' . $all . '[^>]*>)!', '$1', $text);
    $text = preg_replace('!(</?' . $all . '[^>]*>)\s*</p>!', '$1', $text);
    if ($br) {
        $text = preg_replace_callback('/<(script|style|svg).*?<\/\\1>/s', fn($m) => str_replace("\n", '<WPPreserveNewline />', $m[0]), $text);
        $text = str_replace(['<br>', '<br/>'], '<br />', $text);
        $text = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $text);
        $text = str_replace('<WPPreserveNewline />', "\n", $text);
    }
    $text = preg_replace('!(</?' . $all . '[^>]*>)\s*<br />!', '$1', $text);
    $text = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $text);
    return preg_replace("|\n</p>$|", '</p>', $text);
}
function jp_date($fmt, $ts) {
    $wd = ['日', '月', '火', '水', '木', '金', '土']; $o = '';
    foreach (mb_str_split($fmt) as $c) {
        if ($c === 'D') $o .= $wd[(int)date('w', $ts)];
        elseif ($c === 'l') $o .= $wd[(int)date('w', $ts)] . '曜日';
        elseif (strpos('YmdnjyHisGgAa', $c) !== false) $o .= date($c, $ts);
        else $o .= $c;
    }
    return $o;
}
function do_shortcode($s) {
    global $R, $DATA;
    $s = str_replace('[hurl]', $R, $s);
    $s = preg_replace_callback('/\[getCategoryArticle[^\]]*\]/', function () use ($R) {
        $p = array_values(array_filter($GLOBALS['DATA'], fn($d) => $d->type === 'post')); sort_date_desc($p);
        $o = '';
        foreach (array_slice($p, 0, 15) as $x) {
            $t = strtotime($x->date);
            $o .= '<li class="getPost clearfix"><span class="day_date">' . date('Y', $t) . '年' . date('n', $t) . '月' . date('j', $t) . '日</span><p><a href="' . $R . ltrim($x->link, '/') . '">' . htmlspecialchars($x->title) . '</a></p></li>';
        }
        return $o;
    }, $s);
    $s = preg_replace('/\[call_php[^\]]*\]/', '', $s);  // 会員向けの更新通知は、公開しない
    return $s;
}
function apply_content($c) {
    global $wp_autop, $T;
    $c = rel_url($c);
    if ($wp_autop) $c = wpautop($c);
    $c = do_shortcode($c);
    return str_replace('"images/', '"' . $T . '/images/', $c);
}

// ---- ACF互換
function acf_def($name) { global $ACF; return $ACF[$name] ?? null; }
function acf_value($name, $raw) {
    global $R; $d = acf_def($name); $t = $d['type'] ?? 'text';
    if ($raw === null) return null;
    if (in_array($t, ['file', 'image', 'url'])) { return (is_string($raw) && $raw !== '' && $raw[0] === '/') ? $R . ltrim($raw, '/') : rel_url($raw); }
    if ($t === 'wysiwyg') return do_shortcode(wpautop(rel_url($raw)));
    if ($t === 'textarea') { $n = $d['new_lines'] ?? ''; $raw = rel_url($raw); return $n === 'wpautop' ? wpautop($raw) : ($n === 'br' ? nl2br($raw) : $raw); }
    if (in_array($t, ['date_picker', 'date_time_picker'])) {
        if (preg_match('/^(\d{4})-?(\d{2})-?(\d{2})(?:[ T](\d{2}):(\d{2}))?/', $raw, $m)) return jp_date($d['return_format'] ?: 'Y年n月j日', mktime((int)($m[4] ?? 0), (int)($m[5] ?? 0), 0, $m[2], $m[3], $m[1]));
        return $raw;
    }
    if ($t === 'checkbox') { $a = @unserialize($raw); return is_array($a) ? $a : ($raw === '' ? [] : [$raw]); }
    return rel_url($raw);
}
function get_field($name, $id = null) {
    global $post;
    $m = $post->meta ?? [];
    if (!array_key_exists($name, $m)) return ($ACF[$name]['type'] ?? '') === 'checkbox' ? [] : null;
    return acf_value($name, $m[$name]);
}
function the_field($name) { $v = get_field($name); echo is_array($v) ? implode(', ', $v) : $v; }
function get_field_objects($id = null) { global $ACF; $o = []; foreach ($ACF as $n => $d) $o[$n] = ['choices' => $d['choices'] ?? [], 'name' => $n]; return $o; }
function have_rows($name) {  // 入れ子の繰り返し項目（例：special-wrap の中の sp-wrap）に対応
    global $post, $row_stack;
    $top = end($row_stack);
    if ($top && $top['sel'] === $name) {  // 同じ項目のループの続き
        if ($top['i'] + 1 < $top['n']) return true;
        array_pop($row_stack); return false;
    }
    $prefix = $top ? $top['prefix'] . '_' . $top['i'] . '_' . $name : $name;
    $n = (int)($post->meta[$prefix] ?? 0);
    if ($n < 1) return false;
    $row_stack[] = ['sel' => $name, 'prefix' => $prefix, 'i' => -1, 'n' => $n];
    return true;
}
function the_row() { global $row_stack; $row_stack[count($row_stack) - 1]['i']++; }
function get_sub_field($sub) {
    global $post, $row_stack; $t = end($row_stack); if (!$t) return null;
    $k = $t['prefix'] . '_' . $t['i'] . '_' . $sub;
    return array_key_exists($k, $post->meta) ? acf_value($sub, $post->meta[$k]) : null;
}
function the_sub_field($sub) { $v = get_sub_field($sub); echo is_array($v) ? implode(', ', $v) : $v; }

// ---- ループと投稿の情報
function have_posts() { global $loop_i, $posts; if ($loop_i < count($posts)) return true; $loop_i = 0; return false; }
function the_post() { global $loop_i, $posts, $post, $row_stack; $post = $posts[$loop_i++]; $row_stack = []; }
function wp_reset_query() { global $posts, $post; }
function wp_reset_postdata() {}
function setup_postdata($p) { global $post; $post = $p; }
function the_ID() { global $post; echo $post->id; }
function the_title($b = '', $a = '', $echo = true) { global $post; $s = $b . $post->title . $a; if ($echo) echo $s; else return $s; }
function the_time($f = '') { global $post; echo jp_date($f, strtotime($post->date)); }
function the_content() { global $post; echo apply_content($post->content); }
function get_the_excerpt() {
    global $post;
    $e = trim($post->excerpt);
    if ($e === '') { $e = trim(preg_replace('/\s+/u', ' ', strip_tags(do_shortcode($post->content)))); if (mb_strlen($e) > 200) $e = mb_substr($e, 0, 200) . '…'; }
    return $e;
}
function the_excerpt() { echo get_the_excerpt(); }
function permalink() { global $post, $R; $l = $post->type === 'page' ? $post->path . '/' : $post->link; return $R . ltrim($l, '/'); }
function the_permalink() { echo permalink(); }
function has_post_thumbnail() { global $post; return !empty($post->meta['_thumbnail_id']); }
function the_post_thumbnail($size = 'post-thumbnail') { global $post, $R; if (!has_post_thumbnail()) return; echo '<img src="' . $R . ltrim($post->meta['_thumbnail_id'], '/') . '" class="attachment-' . $size . ' size-' . $size . ' wp-post-image" alt="">'; }
function post_class() { global $post; echo 'class="post-' . $post->id . ' ' . $post->type . ' type-' . $post->type . ' status-publish hentry"'; }
function get_posts($a) {
    $r = by_type($a['post_type']);
    if (!empty($a['meta_query'])) { foreach ($a['meta_query'] as $mq) $r = array_values(array_filter($r, fn($d) => ($d->meta[$mq['key']] ?? null) === $mq['value'])); }
    if (($a['orderby'] ?? '') === 'meta_value') { $k = $a['meta_key']; usort($r, fn($x, $y) => strcmp($x->meta[$k] ?? '', $y->meta[$k] ?? '')); if (($a['order'] ?? 'ASC') === 'DESC') $r = array_reverse($r); }
    else sort_date_desc($r);
    return $r;
}
function get_the_tag_list() { return ''; }
function get_post_format() { return false; }
function post_password_required($id = null) { return false; }
function get_the_password_form() { return ''; }
function wp_link_pages() {} function edit_post_link() {} function spacious_entry_meta() {} function spacious_options($k, $d = 0) { return $d; }
function dynamic_sidebar() { return false; } function do_action() {} function get_query_var($v) { return 1; }
function wp_pagenavi() {} function pagination() {}
function __($s, $d = '') { return $s; } function _e($s, $d = '') { echo $s; } function esc_attr__($s) { return $s; }
function esc_url($u) { return $u === '' ? './' : $u; }
function home_url($p = '') {
    global $R;
    // 旧WordPressが、自動で正しいURLへ転送していた「推測URL」を、最初から正しいURLにする
    static $fix = ['/business_checkup_1/' => '/business_checkup/business_checkup_1/', '/business_checkup_2/' => '/business_checkup/business_checkup_2/',
                   '/business_checkup_3/' => '/business_checkup/business_checkup_3/', '/business_checkup_4/' => '/business_checkup/business_checkup_4/',
                   '/introduction/introduction/' => '/introduction/'];
    $p = $fix[$p] ?? $p;
    return $R . ltrim($p, '/');
}
function bloginfo($k) { echo get_bloginfo($k); }
function get_bloginfo($k) { global $T; return $k === 'stylesheet_directory' ? $T : ''; }
function get_stylesheet_directory_uri() { global $T; return $T; }
function remove_filter($a, $b) { global $wp_autop; if ($b === 'wpautop') $wp_autop = false; }

// ---- 条件タグ
function cur_page() { global $q, $posts; return $q['kind'] === 'page' ? $posts[0] : null; }
function is_page($a = null) {
    $p = cur_page(); if (!$p) return false;
    foreach ((array)$a as $x) { if ((string)$x === $p->id || $x === $p->slug || '/' . ltrim($x, '/') === $p->path) return true; }
    return false;
}
function page_is_ancestor_of($slug) { $p = cur_page(); return $p && strpos($p->path . '/', '/' . $slug . '/') === 0 && $p->path !== '/' . $slug; }
function is_tax($tax = null, $term = null) { global $q; if ($q['kind'] !== 'tax') return false; if ($tax !== null && $tax !== $q['tax']) return false; if ($term !== null && $term !== $q['term']) return false; return true; }
function is_home() { return false; } function is_front_page() { return false; } function is_category() { return false; }


// ---- 健診事業ページの部品（新デザイン）
// 問合せ先の「ＴＥＬ３０－９７３１」を、「TEL 0942-30-9731」（タップで電話がかかる）にする。市外局番0942は、ユーザー指示で補う
function ck_tel($html) {
    // 市外局番つき「ＴＥＬ　０９４２－３２－７０６３」
    $html = preg_replace_callback('/ＴＥＬ\s*([０-９0-9]+)[－\-ー]([０-９0-9]+)[－\-ー]([０-９0-9]+)/u', function ($m) {
        $d = array_map(function ($x) { return mb_convert_kana($x, 'n'); }, [$m[1], $m[2], $m[3]]);
        return 'TEL <a class="ck-tel" href="tel:' . $d[0] . $d[1] . $d[2] . '">' . $d[0] . '-' . $d[1] . '-' . $d[2] . '</a>';
    }, $html);
    return preg_replace_callback('/ＴＥＬ\s*([０-９0-9]+)[－\-ー]([０-９0-9]+)/u', function ($m) {
        $a = mb_convert_kana($m[1], 'n'); $b = mb_convert_kana($m[2], 'n');
        return 'TEL <a class="ck-tel" href="tel:0942' . $a . $b . '">0942-' . $a . '-' . $b . '</a>';
    }, $html);
}
function ck_val($key) { ob_start(); the_field($key); return trim(ob_get_clean()); }
function ck_row($label, $key) {
    $v = ck_tel(ck_val($key));
    if (trim(strip_tags($v)) === '') return;
    echo '<div class="ck-row">' . ($label !== '' ? '<dt>' . $label . '</dt>' : '') . '<dd>' . $v . '</dd></div>' . "\n";
}


// ---- 訪問歯科診療ページの部品：項目の中の「空行」や、青い下線の文字リンクを、新しい作りにする
function vd_field($key) {
    $v = ck_val($key);
    $v = str_replace('<p>&nbsp;</p>', '', $v);
    $v = str_replace(' style="text-decoration: underline; text-decoration-color: blue;"', '', $v);
    $v = str_replace('class="underline"', 'class="vd-btn"', $v);
    return $v;
}

// ---- テンプレートの読み込み
function tpl($file) { global $post, $name, $post_id; include __DIR__ . '/theme/' . $file; }
function get_header() {
    global $R, $T, $SITE, $spec, $header_done;
    if ($header_done) return;  // 旧テンプレートが get_header() を2回呼ぶ（ヘッダーの二重表示）ため、1回にする
    $header_done = true;
    $h = str_replace('{{CHROME_HEADER}}', file_get_contents(__DIR__ . '/../templates/chrome_header.html'), file_get_contents(__DIR__ . '/../templates/header.html'));
    $robots = !empty($SITE['preview']) ? '<meta name="robots" content="noindex, nofollow">' : '';
    echo str_replace(['{{R}}', '{{T}}', '{{CV}}', '{{TITLE}}', '{{CANON}}', '{{ROBOTS}}'], [$R, $T, substr(md5(file_get_contents(__DIR__ . '/../wp-content/themes/spacious-child/css/chrome.css').file_get_contents(__DIR__ . '/../wp-content/themes/spacious-child/css/sub.css').file_get_contents(__DIR__ . '/../wp-content/themes/spacious-child/css/cards.css').file_get_contents(__DIR__ . '/../wp-content/themes/spacious-child/style.css')), 0, 8), htmlspecialchars($spec['title'] ?? $SITE['title']), htmlspecialchars($SITE['origin'] . '/' . ($spec['canon'] ?? '')), $robots], $h);
}
function get_footer() {
    global $R, $T;
    $f = str_replace('{{CHROME_FOOTER}}', file_get_contents(__DIR__ . '/../templates/chrome_footer.html'), file_get_contents(__DIR__ . '/../templates/footer.html'));
    echo str_replace(['{{R}}', '{{T}}', '{{YEAR}}'], [$R, $T, date('Y')], $f);
}
function side_cards() { global $R, $T; echo str_replace(['{{R}}', '{{T}}'], [$R, $T], file_get_contents(__DIR__ . '/../templates/side_cards.html')); }   // 右の列の案内カード（top_page.py が作る）
function get_sidebar($n = '') { tpl($n ? "sidebar-$n.php" : 'sidebar.php'); }
function get_template_part($slug, $n = '') {
    global $post, $T;
    if ($slug === 'content' && $n === 'page') {  // 親テーマの content-page.php 相当
        echo '<article id="post-' . $post->id . '" '; post_class(); echo ">\n\t<div class=\"entry-content clearfix\">\n"; the_content();
        echo "\n\t</div>\n\t<footer class=\"entry-meta-bar clearfix\"><div class=\"entry-meta clearfix\"></div></footer>\n</article>\n"; return;
    }
    tpl("$slug-$n.php");
}

// ---- テンプレートの選択
if ($q['kind'] === 'page') {
    $p = $posts[0]; $f = 'page-' . $p->slug . '.php';
    tpl(file_exists(__DIR__ . "/theme/$f") ? $f : 'page.php');
} elseif ($q['kind'] === 'post') { tpl('single.php');
} elseif ($q['kind'] === 'tax') { tpl('taxonomy-' . $q['tax'] . '.php');
} elseif ($q['kind'] === 'archive') { tpl('archive-' . $spec['type'] . '.php');
} else { tpl('404.php'); }
