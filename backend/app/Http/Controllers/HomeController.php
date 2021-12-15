<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\Category;
use App\Enums\PaginationType;


class HomeController extends Controller
{
    public function index()
    {

        // return SearchController::wishSearch($request);
        $query = Item::query();
        
        $categories = Category::where('parent_id','1')->get();
        

        $query->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();


        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item4);
        // 現状は完全一致のみ
        
        return view('home',[
            'items' => $items,'categories' => $categories, 
        ]);


    }
}