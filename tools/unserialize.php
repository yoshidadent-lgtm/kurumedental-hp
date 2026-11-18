<?php
// 標準入力のJSON（キー => PHPシリアライズ文字列）を、JSONに変換する
$in = json_decode(stream_get_contents(STDIN), true);
$out = [];
foreach ($in as $k => $s) { $v = @unserialize($s); $out[$k] = $v === false ? null : $v; }
echo json_encode($out, JSON_UNESCAPED_UNICODE);
