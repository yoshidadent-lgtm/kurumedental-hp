# 手動転送の手順（案B：WinSCPの「同期」）

認証情報は、パソコンの中（WinSCP）だけに置く。GitHubには、預けない。

## 送らないもの（公開してはいけない、または不要なもの）
`.git`、`.github`、`tools`、`templates`、`data`、`docs`、`deploy`、`CLAUDE.md`、`README.md`、`.gitignore`、`.nojekyll`

WinSCPの「除外」の書き方（ファイルマスク）：

```
| .git/; .github/; tools/; templates/; data/; docs/; deploy/; CLAUDE.md; README.md; .gitignore; .nojekyll
```

（上のフォルダ名は、公開用のフォルダの中には、入口以外に存在しないことを、確認済み。）

## 手順
1. GitHub Desktopで、`main` に切り替えて、「Fetch origin」→「Pull origin」で、最新にする。
2. WinSCPで、FTPS（明示的なTLS、ポート21）で接続する。
3. 左（パソコン側）は、取り込んだフォルダ。右（サーバー側）は、**まず試験用フォルダ**（`/home/staging_new/`。なければ、作る）。
4. 上のメニュー「コマンド」→「同期」を開く。方向は「リモート」、モードは「ファイルを同期」。「削除」には、**チェックを入れない**。「転送設定」で、上の除外マスクを入れる。
5. 「比較」を押して、**送られるファイルの一覧**を、確認する（`.git` や `docs` などが、ないこと）。
6. 問題なければ、「実行」を押す。
7. `https://kurume-dental.or.jp/staging_new/` で、表示を確認する。
8. 確認できたら、入口（`/home/`）へ、同じ手順で送る。**この前に、サーバー全体のバックアップを取る。** 入口の `index.php` は、削除せず、`index.php.bak` に名前を変える。入口の `.htaccess` は、控えを取ってから、`deploy/htaccess-root.txt` の内容に置き換える。
9. 公開後の確認：トップと下層ページ、`www` 付き、`http://`、`/kdhs/`（トップ、下層ページ、ログイン画面）。

## 元に戻す方法
- `index.php.bak` を `index.php` に戻す。
- `.htaccess` を、控えに戻す。
- それでも直らなければ、サーバー会社のバックアップから、戻す。
