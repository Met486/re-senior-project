<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Http\Requests\SellItem;
use App\Http\Requests\EditItem;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function index(int $id)
    {
         $items = Item::all();

        return view('search',[
            'items' => $items,
        ]);
    }

    public function showSellForm()
    {
        return view('/items/sell');
    }

    public function sell(SellItem $request)
    {
        $item = new Item();
        $item->title = $request->title;
        $item->category = $request->category;
        $item->sub_category = $request->sub_category;
        $item->isbn_13 = $request->isbn_13;
        // $item->seller_id = 1; //TODO 暫定 ログインしているユーザに変更する
        $item->seller_id = Auth::id(); // ここでログイン情報を取れるらしい

        $item->save();

        return redirect()->route('search'); // todo searchは暫定 追々登録完了ページに送る
    }

    public function showEditForm(int $id)
    {
        $item = Item::find($id);

        return view('items/edit',[
            'item' => $item,
        ]);
    }

    public function showDetail(int $id)
    {
        $item = Item::find($id);
        $user = User::find($item->seller_id);
        
        return view('items/detail',[
            'item' => $item, 'user_name' => $user->name, 'user_id' => $user->id,
        ]);
    }

    public function edit(int $id, EditItem $request)
    {
        $item = Item::find($id);

        $item->title = $request->title;
        $item->status = $request->status;
        $item->category = $request->category;
        $item->sub_category = $request->sub_category;
        $item->isbn_13 = $request->isbn_13;
        // $item->seller_id = 1; //TODO 暫定 ログインしているユーザに変更する
        $item->seller_id = Auth::id();
        $item->save();
        

        return redirect()->route('search');
    }
}
