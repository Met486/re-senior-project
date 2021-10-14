<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\ItemPhoto;
use App\Models\Category;
use App\Http\Requests\SellItem;
use App\Http\Requests\EditItem;
use App\Enums\ItemType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCommentItem;


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
        $categories = Category::where('parent_id',1)->get();
        return view('/items/sell',['categories' => $categories]);


    }
    
    public function sell(SellItem $request)
    {
        $item = new Item();
        $item->title = $request->title;
        $item->category = $request->category;
        // $item->sub_category = $request->sub_category;
        $item->isbn_13 = $request->isbn_13;
        $item->seller_id = Auth::id(); // ここでログイン情報を取れるらしい

        // $item->comment = $request->comment;
        // preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $item->comment, $array);
        
        // $item->url = implode($array[0]);
        // dd($word_list);

        $item->save();

        foreach ($request->file('files') as $index=> $e) {
            $ext = $e['photo']->guessExtension();
            $filename = "{$request->jan}_{$index}.{$ext}";
            // $path = $e['photo']->storeAs('item/photos', $filename);
            $path = $e['photo']->storeAs("item/photos/$item->id", $filename);
            // photosメソッドにより、商品に紐付けられた画像を保存する
            $item->photos()->create(['path'=> $path, 'index' => $index]);
        }

        return redirect()->route('search'); // todo searchは暫定 追々登録完了ページに送る
    }

    public function showEditForm(int $id)
    {
        $item = Item::find($id);
        $categories = Category::where('parent_id',1)->get();

        return view('items/edit',[
            'item' => $item,
        ]);
    }

    public function showDetail(int $id)
    {
        $item = Item::find($id);
        $user = User::find($item->seller_id);
        $photos = ItemPhoto::where('item_id', $id)->get();

        $category = Category::find($item->category);

        // $test_item = Item::find($id)->leftJoin('item_photos','items.id','=','item_photos.item_id')->
        $eva_session = session('evaluation');
        $evaluation;
        if(isset($eva_session))
        {
            $evaluation = session('evaluation');
        }
        else
        {
            $evaluation = Evaluation::where('item_id', $id)->first();
        }

        // dd($evaluation);


        return view('items/detail',[
            'item' => $item, 'user_name' => $user->name, 'user_id' => $user->id, 'photos' =>$photos, 'category_name' =>$category->name, 'evaluation' => $evaluation,
        ]);
    }

    public function edit(int $id, EditItem $request)
    {
        $item = Item::find($id);

        $item->title = $request->title;
        // $item->status = $request->status; // TODO 要修正
        $item->category = $request->category;
        // $item->sub_category = $request->sub_category;
        $item->isbn_13 = $request->isbn_13;
        // $item->seller_id = 1; //TODO 暫定 ログインしているユーザに変更する
        $item->seller_id = Auth::id();
        $item->save();
        

        return redirect()->route('search');
    }

    public function delete($id)
    {
        $item = Item::find($id);


        if(auth()->user()->id != $item->seller_id)
        {
            return back()->with('error','許可されていない操作です');
        }

        $item->delete();
        return redirect(route('search'))->with('success','アイテムを削除しました。');
    }

    public function buy($id)
    {
        $item = Item::find($id);
        $user_id = Auth::id();
        if($user_id == $item->seller_id)
        {
            return back()->with('error','自分のものを買わないで');
        }

        $item->buyer_id = $user_id;
        $item->status = ItemType::in_progress;
        $item->save();

        return back()->with('success','購入処理を行いました');


    }

    public function trade($id)
    {
        $item = ITem::find($id);
        $user_id = Auth::id();

        if($user_id != $item->seller_id)
        {
            return back()->with('error','出品者はあなたではありません');
        }

        if($item->status != ItemType::with_comment)
        {
            return back()->with('error','取引中のアイテムではありません');
        }

        $item->status = ItemType::completed;
        $item->save();

        return back()->with('success','取引処理を行いました');
    }

    public function send($id)
    {
        $item = ITem::find($id);
        $user_id = Auth::id();

        if($user_id != $item->seller_id)
        {
            return back()->with('error','出品者はあなたではありません');
        }

        if($item->status != ItemType::with_comment)
        {
            return back()->with('error','取引中のアイテムではありません');
        }

        $item->status = ItemType::sending;
        $item->save();

        return back()->with('success','発送したことを購入者に通知します');
    }

    public function getSubCategory($id)
    {
        $sub_categories = Category::where('parent_id',$id)->get();
        return $sub_categories;
    }

    public function addComment(int $id, AddCommentItem $request)
    {
        $item = Item::find($id);
        
        if(Auth::id() != $item->seller_id)
        {
            return back()->with('error','あなたは出品者ではありません');
        }

        // if($item->status != ItemType::in_progress)
        // {
        //     return back()->with('error','取引中のアイテムではありません');
        // }


        $item->comment = $request->comment;
        preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $item->comment, $array);
        
    
        $item->url = implode($array[0]);
        if($item->url == "")
        {
            return back()->with('error','URLが含まれていません');
        }

        $item->status = ItemType::with_comment;
        $item->save();

        $user = User::find($item->seller_id);
        $photos = ItemPhoto::where('item_id', $id)->get();

        $category = Category::find($item->category);

        // $test_item = Item::find($id)->leftJoin('item_photos','items.id','=','item_photos.item_id')->
        
        return redirect(route('items.detail',[
            'id' => $id, 'item' => $item, 'user_name' => $user->name, 'user_id' => $user->id, 'photos' =>$photos, 'category_name' =>$category->name,
        ]))->with('success','コメントを追加しました');
    
    }

    
    public function showAddCommentForm(int $id)
    {
        $item = Item::find($id);
        if(Auth::id() != $item->seller_id)
        {
            return redirect(route('search'))->with('error','不正なアクセスです');
        }
        return view('items/addComment',[
            'item' => $item,
        ]);
    }
}
