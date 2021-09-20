<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Enums\PaginationType;

class SearchController extends Controller
{


    public function index(Request $requst){

        $keyword = $requst->input('keyword');

        $query = Item::query();

        if(!empty($keyword))
        {
            $query->where('title','like','%'.$keyword.'%');
        }

        $items = $query->orderBy('created_at','desc')->paginate(PaginationType::Item20);
        
        // 現状は完全一致のみ


        return view('search',[
            'items' => $items,
        ]);
    }
    

    public function listItem(){
        $items = Item::all();

        
        return view('admin',[
            'items' => $items,
        ]);
    }
}
