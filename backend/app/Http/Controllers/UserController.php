<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Evaluation;
use App\Enums\PaginationType;
use App\Enums\ItemType;

class UserController extends Controller
{
    //
    public function showMypage()
    {
        $user_id= Auth::id();
        $user = User::find($user_id);


        return view('users/mypage/mypage',[
            'user' => $user,
        ]);
    }

    public function showUser(int $user_id)
    {
        $user = User::find($user_id);
        $items = Item::orderBy('created_at','DESC')->take(6)->get();
        $good_evaluation = Evaluation::where('status',1)->count();
        $normal_evaluation = Evaluation::where('status',2)->count();
        $bad_evaluation = Evaluation::where('status',3)->count();

        $evaluations = [$good_evaluation, $normal_evaluation, $bad_evaluation];

        // dd($evaluations);

        return view('users/user',[
            'user' => $user, 'items' => $items, 'evaluations' => $evaluations,
        ]);
    }

    public function showSellingList()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $query = Item::query();
        $query->where('seller_id',$user->id)->where('status',ItemType::selling )->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        // $items = Item::where('seller_id',$user->id)->where('status',ItemType::selling )->paginate(PaginationType::Item10);

        return view('users/mypage/listings/listing',[
            'user' => $user,
            'items' => $items,
            'mode' => "出品中",
        ]);
    }

    public function showInProgressList()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $query = Item::query();
        $query->where('seller_id',$user->id)->where('status',ItemType::in_progress )->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);


        // $items = Item::where('seller_id',$user->id)->where('status',ItemType::in_progress )->paginate(PaginationType::Item10);

        return view('users/mypage/listings/listing',[
            'user' => $user,
            'items' => $items,
            'mode' => "取引中",
        ]);
    }

    public function showCompletedList()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $query = Item::query();
        $query->where('seller_id',$user->id)->where('status',ItemType::completed )->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        // $items = Item::where('seller_id',$user->id)->where('status',ItemType::completed )->paginate(PaginationType::Item10);

        return view('users/mypage/listings/listing',[
            'user' => $user,
            'items' => $items,
            'mode' => "売却済",
        ]);
    }

    public function showWithCommentList()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $query = Item::query();
        $query->where('seller_id',$user->id)->where('status',ItemType::with_comment )->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        // $items = Item::where('seller_id',$user->id)->where('status',ItemType::completed )->paginate(PaginationType::Item10);

        return view('users/mypage/listings/listing',[
            'user' => $user,
            'items' => $items,
            'mode' => "入金待ち",
        ]);
    }

    public function showBuyedList()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $query = Item::query();
        $query->where('buyer_id',$user->id)->where('status',ItemType::completed )->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        return view('users/mypage/listings/listing',[
            'user' => $user,
            'items' => $items,
            'mode' => "購入済み",
        ]);
    }
}
