<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{


    public function index(int $id = 0){
        if($id==0){
            $items = Item::all();
        }
        else{
 
        }
        return view('search',[
            'items' => $items,
        ]);
    }
    
}
