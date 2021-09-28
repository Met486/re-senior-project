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

        
        // $test2_items = DB::query()->where('title','like','%'.$keyword.'%')->select($test2_query);
        

        if(!empty($keyword))
        {
            $query->where('title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
            // $query->where('title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')->whereIn('item_photos.item_id',DB::select(DB::raw("select min(id) from item_photos where id = item_photos.id")))->get();
            
            // $query->select(['items.*','item_photos.path'])->distinct()->where('items.title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')
            // ->whereIn('item_photos.id',function($que){
            //     $que->select(DB::raw('min(id)'))
            //     ->from('item_photos')
            //     ->where('id', DB::raw('item_photos.id'));
            //     // ->min('id');
            // })
            // ->get(); 


            // $test2_items->where('title','like','%'.$keyword.'%');
            // $test2_query = "select distinct items.*, item_photos.path from items 
            // inner join item_photos on item_photos.item_id = items.id
            // where items.title like '%" . $keyword . "%'
            // and item_photos.id in (select min(id) from item_photos where id = item_photos.id)";
        }
        else
        {
            $query->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();

            // $query->select(['items.*','item_photos.path'])->distinct()->join('item_photos','items.id', '=' ,'item_photos.item_id')
            // ->whereIn('item_photos.id',function($que){
            //     $que->select(DB::raw('min(id)'))
            //     ->from('item_photos')
            //     ->where('id', DB::raw('item_photos.id'));
            //     // ->min('id');
            // })
            // ->get(); 

            // $test2_query = 'select distinct items.*, item_photos.path from items 
            // inner join item_photos on item_photos.item_id = items.id
            // where item_photos.id in (select min(id) from item_photos where id = item_photos.id)';
        }
        
        // dd($query->toSql(),$query->getBindings());

        // カテゴリ検索は今後
        $categories = Category::where('parent_id',1)->get();


        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        // $test2_items = DB::select($test2_query);
        
        
        // $ids = $items->pluck('id');
        // $photos = ItemPhoto::whereIn('item_id',$ids)->get();

        // 現状は完全一致のみ
        

        return view('search',[
            'items' => $items,'categories' => $categories, 
            // 'items' => $items,'categories' => $categories, 'photos' => $photos,
        ]);
    }
    

    public function listItem(){
        $query = Item::query();
        
        $query->select(['items.*','item_photos.path'])->distinct()->where('items.title','like','%'.$keyword.'%')->join('item_photos','items.id', '=' ,'item_photos.item_id')
        ->where('item_photos.index',0)->get();
        
        // ->whereIn('item_photos.id',function($que){
        //     $que->select(DB::raw('min(id)'))
        //     ->from('item_photos')
        //     ->where('id', DB::raw('item_photos.id'));
        //     // ->min('id');
        // })
        // ->get(); 

        $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);

        $categories = Category::where('parent_id',1)->get();
        
        return view('admin',[
            'items' => $items, 'categories' => $categories,
        ]);
    }
}
