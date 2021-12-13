<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishItem;
use App\Models\WishEvaluation;
use App\Models\User;
use App\Models\Category;
use App\Models\WishItemPhoto;
use App\Http\Requests\WishItemRequest;
use App\Http\Requests\EditItem;
use Illuminate\Support\Facades\Auth;
use App\Enums\ItemType;
use App\Http\Requests\AddCommentItem;

use Illuminate\Support\Facades\Log;

class WishItemController extends Controller
{
    public function search(int $id)
    {
         $items = WishItem::all();

        return view('search',[
            'items' => $items,
        ]);
    }

    public function showWishForm()
    {
        $categories = Category::where('parent_id',1)->get();
        return view('/items/wish',['categories' => $categories]);
    }

    public function wish(WishItemRequest $request)
    {
        $item = new WishItem();
        
        $last_id = WishItem::orderBy('created_at','desc')->first();
        if($last_id != null){
            $last_id_int = $last_id->id;
        }
        else{
            $last_id_int = 0;
        }
        // var_dump($last_id->id);
        
        $item->title = $request->title;
        $item->category = $request->category;
        // $item->sub_category = $request->sub_category;
        $item->isbn_13 = preg_replace('/[^0-9]/','',$request->isbn_13);
        // $item->isbn_13 = $request->isbn_13;
        $item->scratches = $request->scratches;
        $item->wisher_id = Auth::id(); // ここでログイン情報を取れるらしい
        $item->price = $request->price;

        // $item->save();

        // $cover_link = $request->cover;
        // $ext = substr($cover_link, strrpos($cover_link, '.') + 1);
        // $id = $last_id_int + 1;
        // if($cover_link){
        //     $data = file_get_contents($cover_link);
        //     file_put_contents("item/wish_photos/$id.$ext",$data);   
        //     $item->cover_path = ("item/wish_photos/$id.$ext");
        // }

        $item->save();
        $photo = new WishItemPhoto();

        $cover_link = $request->cover;
        $ext = substr($cover_link, strrpos($cover_link, '.') + 1);
        $id = $last_id_int + 1;
        if($cover_link){
            $data = file_get_contents($cover_link);
            mkdir("item/wish_photos/$item->id");
            
            file_put_contents("item/wish_photos/$item->id/0.$ext",$data);   
            // $item->cover_path = ("item/wish_photos/$id.$ext");
            $photo->item_id = $item->id;
            $photo->index = 0;
            $photo->path = "item/wish_photos/$item->id/0.$ext";
            $photo->save();
        }




        return redirect()->route('search'); // todo searchは暫定 追々登録完了ページに送る
    }

    public function showDetail($id)
    {
        $item = WishItem::find($id);

        // var_dump($item);
        $user = User::find($item->wisher_id);

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
            $evaluation = WishEvaluation::where('item_id', $id)->first();
        }

        // dd($evaluation);


        return view('items/wishDetail',[
            'item' => $item, 'user_name' => $user->name, 'user_id' => $user->id,  'category_name' =>$category->name, 'evaluation' => $evaluation,
        ]);
    }
    public function delete($id)
    {
        $item = WishItem::find($id);


        if(auth()->user()->id != $item->wisher_id)
        {
            return back()->with('error','許可されていない操作です');
        }

        $item->delete();
        return redirect(route('search'))->with('success','アイテムを削除しました。');
    }

    public function sell($id)
    {
        $item = WishItem::find($id);
        $user_id = Auth::id();
        if($user_id == $item->wisher_id)
        {
            return back()->with('error','自分のものを売らないで');
        }

        $item->seller_id = $user_id;
        $item->status = ItemType::in_progress;
        $item->save();

        return back()->with('success','販売挙手処理を行いました');
    }

    public function trade($id)
    {
        $item = WishItem::find($id);
        $user_id = Auth::id();

        if($user_id != $item->wisher_id)
        {
            return back()->with('error','希望者はあなたではありません');
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
        $item = WishItem::find($id);
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

        return back()->with('success','発送したことを希望者に通知します');
    }

    public function addComment(int $id, AddCommentItem $request)
    {
        $item = WishItem::find($id);
        
        if(Auth::id() != $item->wisher_id)
        {
            return back()->with('error','あなたは希望者ではありません');
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
        // $photos = ItemPhoto::where('item_id', $id)->get();

        $category = Category::find($item->category);

        // $test_item = Item::find($id)->leftJoin('item_photos','items.id','=','item_photos.item_id')->
        
        return redirect(route('wish_items.detail',[
            'id' => $id, 'item' => $item, 'user_name' => $user->name, 'user_id' => $user->id,  'category_name' =>$category->name,
        ]))->with('success','コメントを追加しました');
    
    }

    
    public function showAddCommentForm(int $id)
    {
        $item = WishItem::find($id);
        if(Auth::id() != $item->wisher_id)
        {
            return redirect(route('search'))->with('error','不正なアクセスです');
        }
        return view('items/wishAddComment',[
            'item' => $item,
        ]);
    }
}
