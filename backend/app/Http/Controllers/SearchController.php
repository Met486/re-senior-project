<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Enums\PaginationType;
use App\Models\Category;
use App\Models\ItemPhoto;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{


    public function index(Request $requst){

        $keyword = $requst->input('keyword');

        $query = Item::query();

        if(!empty($keyword))
        {
            $query->where('title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();

        }
        else
        {
            $query->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
        }
        
        // dd($query->toSql(),$query->getBindings());

        // カテゴリ検索は今後
        $categories = Category::where('parent_id',1)->get();


        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);
        // 現状は完全一致のみ
        

        return view('search',[
            'items' => $items,'categories' => $categories, 'keyword' => $keyword,
        ]);
    }
    

    public function listItem(){
        $query = Item::query();
        
        $query->select(['items.*','item_photos.path'])->distinct()->where('items.title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')
        ->where('item_photos.index',0)->get();
        

        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        $categories = Category::where('parent_id',1)->get();
        
        return view('admin',[
            'items' => $items, 'categories' => $categories,
        ]);
    }
}
