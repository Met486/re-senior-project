<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\WishItem;
use App\Enums\PaginationType;
use App\Models\Category;
use App\Models\ItemPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kalnoy\Nestedset\NestedSet;


class SearchController extends Controller
{
    public function index(Request $request){

        
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $category2 = $request->input('category2');
        $category3 = $request->input('category3');
        $price = $request->input('price');
        $WISH = $request->input('isWish');
        // var_dump($request->input('isWish'));

        if(!strcmp($WISH,"true") == 0){
            // return SearchController::wishSearch($request);
            $query = Item::query();
            
            $categories = Category::all();
            
            if(!empty($keyword))
            {
                $query->where('title','like','%'.$keyword.'%')->join('categories','items.category', '=', 'categories.id')->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
            }
            else
            {
                $query->join('categories','items.category', '=', 'categories.id')->join('item_photos','items.id', '=' ,'item_photos.item_id')->where('item_photos.index',0)->get();
            }
            
            if(!empty($price))
            {
                Log::debug("price is $price");
                $query->where('price','>=',$price)->get();
            }
            else
            {
                Log::debug("price is not exist");
            }
            
            
            $parent;
            $array;
            
            if(!empty($category)){
            if(!empty($category2)){
                if(!empty($category3)){
                    $parent = $categories->find($category3);
                }
                else{
                    $parent = $categories->find($category2);
                }
            }
            else{
                $parent = $categories->find($category);
            }

            if(!empty($category3)){$array = [$category3];}
            else {$array = $parent->descendants()->pluck('id');}
            Log::debug($array);
            $query->whereIn('category',$array)->get();
            
            }       
        
        // dd($query->toSql(),$query->getBindings());
        
            $items = $query->orderBy('items.created_at','desc')->paginate(PaginationType::Item20);
            // 現状は完全一致のみ
            
            return view('search',[
                'items' => $items,'categories' => $categories, 'keyword' => $keyword, 'k1_category' => $category, 'k2_category' => $category2, 'k3_category' => $category3, 'price' => $price, 'isWish' => $WISH,
            ]);
        }
        else
        {
            $query = WishItem::query();

            $categories = Category::all();
    
            if(!empty($keyword))
            {
                $query->where('title','like','%'.$keyword.'%')->join('categories','wish_items.category', '=', 'categories.id')->join('wish_item_photos','wish_items.id', '=' ,'wish_item_photos.item_id')->get();
            }
            else
            {
                $query->join('categories','wish_items.category', '=', 'categories.id')->join('wish_item_photos','wish_items.id', '=' ,'wish_item_photos.item_id')->get();
            }
    
            if(!empty($price))
            {
                $query->where('title','>',$price)->get();
            }
    
            $parent;
            $array;
    
            if(!empty($category)){
                if(!empty($category2)){
                    if(!empty($category3)){
                        $parent = $categories->find($category3);
                    }
                    else{
                        $parent = $categories->find($category2);
                    }
                }
                else{
                    $parent = $categories->find($category);
                }
    
                if(!empty($category3)){$array = [$category3];}
                else {$array = $parent->descendants()->pluck('id');}
                Log::debug($array);
                $query->whereIn('category',$array)->get();
    
            }       
            
            // dd($query->toSql(),$query->getBindings());
            $items = $query->orderBy('wish_items.created_at','desc')->paginate(PaginationType::Item20);
            // 現状は完全一致のみ
            // var_dump($items);
            
            return view('search',[
                'items' => $items,'categories' => $categories, 'keyword' => $keyword, 'k1_category' => $category, 'k2_category' => $category2, 'k3_category' => $category3, 'price' =>$price, 'isWish' => $WISH,
            ]);
        }
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
