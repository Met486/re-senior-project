## 出品物検索
### 出入力
|項目|出入力|
|-|-|
|検索フォーム |入力 |
|物品名|出力|
|物品写真|出力|

### アクション
|項目|種類|働き|
|-|-|-|
|送信|ボタン|検索し、検索物一覧ページへ遷移する|


## 出品物単体
### 出入力
|項目|出入力|
|-|-|
|物品名|出力|
|物品写真|出力|
|出品者|出力|

### アクション
|項目|種類|働き|
|-|-|-|
|交渉|送信|交渉の意思を送信する|
|取り消し|送信|（自分の物品であれば）出品を取り消し、自身の物品一覧に遷移|

## 出品登録
### 出入力
|項目|出入力|
|-|-|
|物品名|入力|
|物品写真|入力|

### アクション
|項目|種類|働き|
|-|-|-|
|送信|ボタン|物品を新規登録し、登録確認ページへ遷移|

## ユーザーページ
### 出入力

|項目|出入力|
|-|-|
|ユーザ名|出力|
|取引情報|出力|

### アクション

## マイページ
### 出入力
|項目|出入力|
|-|-|
|ユーザ名|出力|
|出品物一覧|出力|
|出品実績|出力|

### アクション
|項目|種類|働き|
|-|-|-|
|ユーザ名変更|リンク（ダイアログ）|ダイアログを表示する

## 交渉用チャット
### 出入力
|項目|出入力|
|-|-|
|ユーザ名|出力|

### アクション
|項目|種類|働き|
|-|-|-|


## ユーザー登録
### 出入力
|項目|出入力|
|-|-|
|ユーザ名|入力|
|メールアドレス|入力|
|電話番号|入力|

### アクション
|項目|種類|働き|
|-|-|-|
|送信|ボタン|ユーザー情報を登録し、承認用ページに遷移する。|


## ヘッダー
### 出入力
|項目|出入力|
|-|-|
|アプリ名|出力|
|検索フォーム|入力|
|ユーザー情報|出力|

### アクション
|項目|種類|働き|
|-|-|-|
|検索|ボタン|クエリに応じた検索ページへ遷移


# テーブル
## 出品物テーブル

|カラム論理名|カラム物理名|型|型の意味|
|-|-|-|-|
|ID|id|SERIAL|連番(自動採番)|
|物品名|title|VARCHAR(32)|32文字までの文字列|
|出品者ID|seller_id|INTEGER|数値 外部キー|
|カテゴリー|category|INTEGER|数値
|ISBN13|isbn_13|VARCHAR(13)|13文字までの文字列
|状態|status|INTEGER|数値|
|作成日|created_at|TIMESTAMP|日付と時刻|
|更新日|updated_at|TIMESTAMP|日付と時刻|

## ユーザーテーブル
|カラム論理名|カラム物理名|型|型の意味|
|-|-|-|-|
|ID|id|SERIAL|連番（自動採番)|
|ユーザー名|name|VARCHAR(32)|32文字までの文字列|
|メールアドレス|mail_address|VARCHAR(32)|128文字までの文字列|
|作成日|created_at|TIMESTAMP|日付と時刻|
|最終ログイン|last_login_at|TIMESTAMP|日付と時刻|




# URL
|URL|メソッド|処理|
|-|-|-|
|/test|GET|テスト用の一覧ページ|
|/items/{id}|GET|物品単体のページを表示する|
|/search/?keyword=xxx|GET|検索ページを表示する|
|/put|GET|物品登録ページを表示する|
|/put|POST|物品を登録する|
|/signup|POST|ユーザーを登録する前画面(認証系使うならここで終わり)|
|/signup/registration|POST|ユーザーを登録する|
|/category/xxx(カテゴリー番号)|GET|カテゴリー検索を行うページを表示する|
|/mypage|GET|マイページを表示|
|/mypage/listings/listing|GET|自身の出品中の物品を表示|
|/mypage/listings/in_progress|GET|自身の取引中の物品を表示|
|/mypage/listings/completed|GET|自身の取引終了した物品を表示|
|/mypage/negotiate|GET|交渉中の物品一覧を表示|
|/mypage/negotiate/item=xxx|GET|交渉中の物品の詳細を表示|
