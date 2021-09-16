<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{


    public function index(Request $requst){

        $keyword = $requst->input('keyword');

        $query = Item::query();

        if(!empty($keyword))
        {
            $query->where('title','like','%'.$keyword.'%');
        }

        $items = $query->orderBy('created_at','desc')->paginate(5);
        
        // 現状は完全一致のみ


        return view('search',[
            'items' => $items,
        ]);
    }
    
}
