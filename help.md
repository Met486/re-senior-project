# 構成に困ったら見よう

## Vue

### 反映されないぜ？
`php aritisan serve`

↑PHP側で動かすの忘れてない？

その後`npm run dev`も忘れずに

毎回実行するのがだるいなら`npm run watch-poll`がおすすめ


無理やり更新する
### そもそもどこ編集してんの
resource/js/ExampleComponent.vue
といったような場所に Vue のファイルがあります。
そこを編集していくことになるでしょう（多分）

app.jsにはVueのコンポーネントのルーティングがあるので追加するときはそこを忘れずに編集すること？

## Laravel

### ルーティング

routes/web.php
にどんどん記載していきます。

実際のページは
resources/views/
にどんどん作っていきましょう。
blade.php をたくさん作ることになるのかな？

## なんかエラー出た

### syntax error が "namespace"で出た

1 行目の"<?php"が"<? php"みたいに空白含まれてたりせん？

### [Firebase]ServiceAccount クラスがなくて使えないぞ

config/app.php の Provider に
`Kreait\Laravel\Firebase\ServiceAccount::class`を追加すればいける
→ だめかも
Provider に突っ込むとそんなもんないぞと言われる
->古い方使ってた

### syntax error じゃなさそうなのになんか言われる

前の行の末尾に";"が抜けてないか確認しよう

### invailed error 見つからねえよって言われてんぜ

serviceAccout の取得のための json ファイルの指定ができねえ！
->いらないことをしすぎてた
ファサード（メソッド？）の引数に Database $databaseをいれて、中で$this->database = $database でよかった。
（もしかするとそれすらいらないのかもしれん…）
->流石にそんなことはなかった

正確には動くけど、ちゃんと宣言したほうがいい

getReference でデータベースの取得、orderByXXX で何かしら指定、
limitToXXXX は順に撮るだけなので SQL の WHERE に該当するわけではない

orderByChild('')
equalTo で決める

### 一つ一つ開くのがおせ〜

アドレス問題なので localhost から 127.0.0.1 とかに変えると良い
config/app.php の l55 を変えた


### vue使うときの参考
https://qiita.com/fruitriin/items/e0f2c9aa035c3ff2c874#laravel%E3%81%A7vue%E3%82%92%E4%BD%BF%E3%81%86%E7%B7%A8
```
<!-- Headタグ内に足す -->
<meta name="csrf-token" content="{{ csrf_token() }}">
```

```
<!-- Headタグ内に足す -->
<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
```

```
<div id="app">
    <!-- デフォルトだとこの中ではvue.jsが有効 -->
    <!-- example-component はLaravelに入っているサンプルのコンポーネント -->
    <example-component></example-component>
</div>
<!-- body タグの最後に足す-->
<script src=" {{ mix('js/app.js') }} "></script>

```


### 知らん用語

### V-bindとV-modelの違い
https://www.shookuro.com/entry/2018/09/09/100908


どうやらv-modelはModelとHTMLを双方向に監視している。どちらかの値が変更されればそちらに合わせて変更される
（Modelの値を変更して即時に反映されるかは未検証)

v-bindはHTMLで入力してもModelには影響がない



### 雑記
なんか面接中に言っちゃったのはデータ解析して、この人がどういう出品傾向なのかを表示する機能



npm run watch-poll

反映が早いよ

`<div id="app"></div>`の中じゃないとVueは動かん。

`div`の後には`        <script src="{{ asset('/js/app.js') }}"></script>`もいる


indexonはfirebase側の問題、ルールを追加しよう


### 更新されね～
php-firebaseのドキュメントが更新されてなさすぎるんだが？？？
goで書き直したほうがいい気がしてくるレベルだけど、Firebaseのとこだけだし我慢したほうがいいのかね…

特にFactory関連はすべて死んでるので使ってはいけない

以下の例の感じで整えてやるといいことが多い

更新されてない一例
`$request = \Kreait\Auth\Request\CreateUser::new()`

これは`$request = \Kreait\Firebase\Request\CreateUser::new()`が正解

参考→https://github.com/kreait/firebase-php/issues/304



### これからやること
`RegisterComponent.vue`から`TestRegisterController.php`に値を送れたので、登録できるかをリターン、できればできたことを返し、できなければ変えるように指示。

→リターンするよりも違う画面遷移すべきだわ
emailお被りするようならデータは送りつつ、そのメールアドレスだめだわということだけ提示スべき

#### 結局
フロントで認証を通してLaravel側で確認を取る形じゃないとだめだこりゃという感じ

DBは極力使わない構成にしたいけどどうなるやら

### firstOrCreateで全然値が入らない！どうしたらいい！？
Model側の問題。`Models/XXX`の`$filliable`に値がないと登録してくれないらしい
https://blog.kiwatchi.com/70%E6%97%A5%E7%9B%AE-%E5%80%8B%E4%BA%BA%E9%96%8B%E7%99%BA%E8%A8%98-10-firstorcreate%E3%81%A7%E3%83%8F%E3%83%9E%E3%81%A3%E3%81%9F/


 docker exec -it 14b24862193c bash

 
mysql -u root -p


### Routeが見つからないって言われるんだけど？？
web.phpのルーティングミス
コントローラからredirectするときにrouteを作ると思うけど、名前付きルーティングじゃないと認識しないよ
`Route::get('/search',[SearchController::class,'index'])->name('search');`
(useは省略)

最後の->name()が重要

### paginate(n)ってなに？
n件表示したら次のページになるように生成するよっていう意味


# 重要
### ファイルシステムいじったよ
`config/filesystems.php`

保存場所の変更


### これを実行したいんじゃい
`select items.*,GROUP_CONCAT(item_photos.path) from items left join item_photos on items.id = item_photos.item_id group by items.id;`

結局ItemPhotoのモデルを書き換えて画像番号(index)を追加して簡略化

### 413エラー
httpsのせいかもしれんね

443番ポートに追加する必要があったりするらしい
https://blog.capilano-fw.com/?p=256

### なぜかRouteが見つからんが？
`Route::put('/items/{id}/', [ItemController::class,'buy'] )->name('items.buy');`

`Route::put('/items/{id}/', [ItemController::class,'trade'] )->name('items.trade');`

これが連続して並ぶと区別がつかないらしい

`Route::put('/items/{id}/buy', [ItemController::class,'buy'] )->name('items.buy');`

`Route::put('/items/{id}/trade', [ItemController::class,'trade'] )->name('items.trade');`

こうしてやるといいよ