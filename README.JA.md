# FoundationPressNG

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/olefredrik/foundationpress?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![GitHub version](https://badge.fury.io/gh/olefredrik%2Ffoundationpress.svg)](https://github.com/olefredrik/FoundationPress/releases)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

日本語 | [English](./README.md)

> NG is New Generation. olefredrikさんの[FoundationPress](https://github.com/olefredrik/FoundationPress)を基にしています。

これは、世界で最も先進的なレスポンシブ（モバイルファースト）フレームワークであるZurbの[Foundation for Sites 6](https://get.foundation)をベースにしたWordPressのスターターテーマです。FoundationPressNGの目的は、あらゆるデザインを構築するために必要な必需品を含む、小さくて便利なツールボックスとして機能することです。FoundationPressNGは、最終的な製品ではなく、出発点となることを意図しています。

フォーク、コピー、修正、削除、共有、好きなようにしてください。

すべての貢献を歓迎します!

## 必要条件

**このプロジェクトでは、[Node.js](http://nodejs.org) v12.1.0以上を推奨しています。

FoundationPressNGでは、[Sass](http://Sass-lang.com/) (超強力なCSS)を使用しています。Sassとは、簡単に言うと、スタイルをより効果的に整然と書けるようにするCSSプリプロセッサです。

Sassはlibsassを使ってコンパイルされているので、マシンにGCCをインストールする必要があります。Windowsユーザーは[MinGW](http://www.mingw.org/)から、Macユーザーは[Xcode Command-line Tools]`$ xcode-select --install`でインストールできます。

<!-- Sassベースのワークフローを使ったことがない方は、[FoundationPress for beginners](https://foundationpress.olefredrik.com/posts/tutorials/foundationpress-for-beginners)を読むことをお勧めします。 -->

## クイックスタート

### 1. リポジトリをクローンし、npmでインストールします。
```bash
$ cd my-wordpress-folder/wp-content/themes/の
$ git clone git@github.com:annrie/FoundationPressNG.git
$ cd FoundationPress
$ npm install
```
### 1-2. yarn 2　の場合
```bash
$ npx @yarnpkg/doctor
$ echo "nodeLinker: node-modules" >> .yarnrc.yml
$ yarn install
```

### 2. 設定

#### YAML設定ファイル
FoundationPressには、`config-default.yml` ファイルが含まれています。設定を変更するには、`config-default.yml` のコピーを作成して `config.yml` という名前にして、それに変更を加えます。config.yml` ファイルは git に無視されるので、環境ごとに異なる設定を同じ git repo で使うことができます。

ビルド処理の開始時には、`config.yml` ファイルが存在するかどうかのチェックが行われます。もし `config.yml` が存在すれば、設定は `config.yml` から読み込まれます。config.yml` が存在しない場合は、`config-default.yml` がフォールバックとして使用されます。

#### Browsersyncの設定
Browsersync](https://www.browsersync.io/) (ファイル保存時のブラウザの自動更新)を利用したい場合は、前のステップで作成した `config.yml` ファイルを開き、`BROWSERSYNC` オブジェクトの下の `url` プロパティにローカルの開発サーバのアドレスとポート (例: http://localhost:8888) を指定してください。

#### 静的アセットハッシュ/キャッシュブレイカー
テーマを再デプロイした後にユーザーが最新の変更点を確認できるようにしたい場合は、静的アセットハッシュを有効にすることができます。`config.yml` の中で ``REVISIONING: true;`` を設定してください。ハッシュ化は ``npm run build`` と ``npm run dev`` コマンドで有効になります。BrowserSyncを使ったstartコマンドには適用されません。これは設計によるものです。 ハッシュ化が変更されるのはファイルに実際に変更があった場合のみです。

### 3. 開始

```bash
$ npm start or yarn start
```

### 4. 本番用のアセットを作成する

本番用にビルドする場合、CSSとJSはミニ化されます。/dist` フォルダ内のアセットをminify化するには、以下のように実行します。

```bash
$ npm run build or yarn build
```

#### テーマの.zipファイルを作成するには、以下のように実行してください。

```bash
$ npm run package or yarn package
```

このコマンドを実行すると、テーマのアセットをビルドしてminify化し、テーマの.zipアーカイブを `packaged` ディレクトリに配置します。これは、テーマをステージングサーバや本番サーバに転送するためにテーマを軽量化するために、`/node_modules`, `/src` などの開発者用ファイル/ディレクトリをテーマから除外します。

### プロジェクトの構造

`/src` フォルダにはすべてのアセットの作業ファイルがあります。Gulpによって監視されているファイルに変更を加えるたびに、出力は `/dist` フォルダに保存されます。このフォルダの内容はコンパイルされたコードであり、(よほどの理由がない限り)触ってはいけません。

ページテンプレート`/page-templates`フォルダには、WordPress管理パネルの「ページ」セクションで選択できるテンプレートが入っています。新しいページテンプレートを作成するには、このフォルダに新規ファイルを作成して、テンプレート名を指定するだけです。

あとはかなり自己説明的な感じでしょうか。行き詰った時はお気軽にお尋ねください。

### スタイルとSassのコンパイル

 * `style.css`. このファイルは気にしないでください。(なぜか)WordPressでは必須です。すべてのスタイリングは後述のSassファイルで処理されます。

 * `src/assets/scss/app.scss`. すべてのスタイルのインポートをここで行います。
 * `src/assets/scss/global/*.scss`. グローバル設定
 * `src/assets/scss/components/*.scss`. ボタンなど。
 * `src/assets/scss/modules/*.scss`: ボタンなど。トップバーやフッターなど。
 * `src/assets/scss/templates/*.scss`: トップバー，フッターなど
 * `src/assets/scss/modules/*.scss`: トップバー，フッターなど
 * `src/assets/scss/templates/*.scss`: ページテンプレートのスタイリング
 * `dist/assets/css/app.css`. このファイルはドキュメントの `<head>` セクションに読み込まれ、プロジェクト用にコンパイルされたスタイルが含まれています。

Sass を初めて使う方は、scss ファイルを変更しても `app.css` にコンパイルされるようにするためには、バックグラウンドで Gulp を起動しておく必要があることに注意してください (``npm start``)。

### JavaScriptのコンパイル

Foundationのモジュールを含むすべてのJavaScriptファイルは、`src/assets/js/app.js`ファイルを通してインポートされます。ファイルは、[webpack](https://webpack.js.org/)をモジュールバンドルラーとして、モジュール依存性を使ってインポートされます。

モジュールやモジュールのバンドルについてよく知らない場合は、[this resource for node style require/exports](http://openmymind.net/2012/2/3/Node-Require-and-Exports/)や[this resource to understand ES6 modules](http://exploringjs.com/es6/ch_modules.html)を参照してください。

ファウンデーションモジュールは `src/assets/js/app.js` ファイルにロードされます。デフォルトではすべてのコンポーネントがロードされます。また、どのモジュールをインクルードするかを選択することもできます。ファイルの指示に従うだけです。

追加のJavaScriptファイルを `app.js` とは別に出力する必要がある場合は、以下のようにします。
* 新しい `custom.js` ファイルを `src/assets/js/` に作成します。jQueryを使用する場合は、ファイルの先頭に `import $ from 'jquery';` を追加します。
* `config.yml` で、`PATHS. entries` に `src/assets/js/custom.js` を追加する。
* ビルド (`npm start`)
* これで `dist/assets/js/` ディレクトリに `custom.js` ファイルが出力されます。

## デモ

* [初期状態のFoundationPressNGインストールサイト](https://foundationpressng.phantomoon.com)
* [FoundationPressNGキッチンシンク-動作中のすべての要素を確認する](https://foundationpressng.phantomoon.com/kitchen-sink/)

## ローカルサイト
ローカルでのWordPress開発には、以下のいずれかの設定をお勧めします。

* [MAMP](https://www.mamp.info/en/) (macOS)
* [WAMP](http://www.wampserver.com/en/download-wampserver-64bits/) (Windows)
* [LAMP](https://www.linux.com/learn/easy-lamp-server-installation) (Linux)
* [Local](https://local.getflywheel.com/) (macOS/Windows)
* [VVV（VVV（Varying Vagrant Vagrants））](https://github.com/Varying-Vagrant-Vagrants/VVV)  (Vagrant Box)
* [Trellis](https://roots.io/trellis/)
* [vccw](git@github.com:vccw-team/vccw.git) (Vagrant Box)

## チュートリアル

<!-- * [FoundationPress for beginners](https://foundationpress.olefredrik.com/posts/tutorials/foundationpress-for-beginners/) -->
* [Responsive images in WordPress with Interchange](http://rachievee.com/responsive-images-in-wordpress/)
* [Learn to use the _settings file to change almost every aspect of a Foundation site](http://zurb.com/university/lessons/66)
* [Other lessons from Zurb University](http://zurb.com/university/past-lessons)

## ドキュメンテーション

* [Zurb Foundation Docs](https://get.foundation/frameworks-docs.html)
* [WordPress Codex](https://codex.wordpress.org/)

## ショーケース

* [Harvard Center for Green Buildings and Cities](http://www.harvardcgbc.org/)
* [The New Tropic](http://thenewtropic.com/)
* [Parent-Child Home Program](http://www.parent-child.org/)
* [Hip and Healthy](http://hipandhealthy.com/)
* [Franchise Career Advisors](http://franchisecareeradvisors.com/)
* [Maren Schmidt](http://marenschmidt.com/)
* [Finnerodja](http://www.finnerodja.se/)
* [WP Diamonds](http://www.wpdiamonds.com/)
* [Storm Arts](http://stormarts.fi/)
* [ProfitGym](http://profitgym.nl/)
* [Agritur Piasina](http://www.agriturpiasina.it/)
* [Byington Vineyard & Winery](https://byington.com/)
* [Show And Tell](http://www.showandtelluk.com/)
* [Wahl + Case](https://www.wahlandcase.com/)
* [Morgridge Institute for Research](https://morgridge.org)
* [Impeach Trump Now](https://impeachdonaldtrumpnow.org/)
* [La revanche des sites](https://www.la-revanche-des-sites.fr/)
* [Dyami Wilson](https://dyamiwilson.com)
* [Madico Solutions](https://madico.com)

>このリストに掲載されるべきサイトを作ったことはありますか？このリストに載せるべきサイトを作ったことがありますか？[教えてください](https://twitter.com/muraie_jin)

<!-- ## 貢献する
#### 参加方法をご紹介します。

1. スター](https://github.com/olefredrik/FoundationPress/stargazers)プロジェクトに参加する。
2. 2. [GitHub issues](https://github.com/olefredrik/FoundationPress/issues) を通じて寄せられた質問に答える。
3. 見つけたバグを報告する
4. FoundationPressの上に構築したテーマを共有する
5. あなたのFoundationPressを使った経験を[Tweet](https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Ffoundationpress.olefredrik.com%2F&text=Check%20out%20FoundationPress%2C%20the%20ultimate%20%23WordPress%20starter-theme%20built%20on%20%23Foundation%206&tw_p=tweetbutton&url=http%3A%2F%2Ffoundationpress.olefredrik.com&via=olefredrik)と[blog](http://www.justinfriebel.com/my-first-experience-with-foundationpress-a-wordpress-starter-theme-106/)で紹介してください。 -->

#### プルリクエスト

プルリクエストは大歓迎です。以下のガイドラインに従ってください。

1. 問題を解決する。機能は素晴らしいものですが、それ以上に優れているのは、あなたが発見したコードの問題をクリーンアップして修正することです。
2. あなたのコードにバグがなく、新しいバグを導入していないことを確認してください。
3. プルリクエスト](https://help.github.com/articles/creating-a-pull-request)を作成します。
4. すべての Travis-CI ビルドチェックに合格していることを確認します。
