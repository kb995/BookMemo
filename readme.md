# BookQuote
**アプリ名: BookQuote**<br>
**URL: (準備中)**


## 概要
本アプリでは手軽に蔵書管理ができることに加え、書籍ごとにメモを保存することができます。<br>
メモはフォルダーごとに管理できますので、引用文(アプリ名であるQuote)や語彙フォルダーを作って記録したり、<br>
読書中の疑問やメモに使うなど、利用者の用途に合わせて自由な使い方ができます。


## 開発背景
#### (準備中)


## アプリ使用イメージ
#### (準備中)


## 使用技術
* フロントエンド
    * マークアップ( HTML / CSS / SASS / Bootstrap )
    * jQuery 3.3.1
* バックエンド
    * PHP 7.3.23
    * Laravel 6.19.1
    * mysql 5.5.68
* インフラ
    * AWS( VPC / EC2 / RDS / Route53 / CodeDeploy / S3 / IAM / CloudWatch)
    * Docker(開発) 19.03.12
    * DockerCompose(開発) 1.27.2,
    * CircleCI/CD 2.1
    * nginx 1.18.0
* 他ツール
    * VisualStudioCode
    * iTerm
    * Git/GitHub
    * MAMP(開発初期)

## 機能一覧
* ユーザー・認証関連
    * 新規ユーザー登録機能
    * ログイン&ログアウト機能
    * プロフィール編集機能
    * サムネイル画像アップロード　　　

* 書籍関連
    * 書籍手入力登録/編集/削除
    * 本棚検索機能
    * ページング

* 引用(メモ)関連
    * メモ登録/編集/削除
    * メモ内キーワード検索
    * フォルダー登録/削除
    * ページング

* GoogleAPI連携
    * キーワード検索から書籍情報取得
    * API取得情報から書籍登録機能

* その他機能
    * 全ページレスポンシブ対応(PC~SP)
    * パンくずリスト(breadcrumb)
    * フラッシュメッセージ(toaster)
    * 書籍詳細表示(bootstrap/アコーディオン)
    * 画像アップロードリアルタイム表示

* 今後の実装予定
    * バーコードからの書籍登録
    * 利用方法のガイダンス機能
    * Vue.jsを使用してSPA
    * デザイン面のブラッシュアップ
    * Route53による名前解決
    * テストコードの追加


## インフラ構成
#### (準備中)
