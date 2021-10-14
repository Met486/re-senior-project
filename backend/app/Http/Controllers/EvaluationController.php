<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    // public function create(Request $request)
    // {
    //     $evaluation = new Evaluation();
    //     if($request->status != ""){
    //         $evaluation->status = $request->status;
    //     }
        
    //     $evaluation->seller_id = $request->seller_id;
    //     $evaluation->buyer_id = Auth::id();
    //     $evaluation->item_id = $request->item_id;
    //     $evaluation->comment = $request->comment;
        
    //     $evaluation->save();
        
    //     return back();
    // }
    
    // public function create($id, int $value)
    // {
    //     $evaluation = new Evaluation();

    //     $item = Item::find($id);

    //     $evaluation->seller_id = $item->seller_id;
    //     $evaluation->buyer_id = Auth::id();
    //     $evaluation->item_id = $id;
    //     $evaluation->status = $value;
        
    //     // commentは後回し
        
    //     $evaluation->save();
        
    //     return back();
    // }

    public function create(Request $request)
    {
        $evaluation = new Evaluation();

        $item = Item::find($request->id);

        $evaluation->seller_id = $item->seller_id;
        $evaluation->buyer_id = Auth::id();
        $evaluation->item_id = $request->id;
        $evaluation->status = $request->value;
        
        // commentは後回し
        $evaluation->comment = "";
        
        $evaluation->save();
        
        return redirect()->back()->withInput()->with('evaluation',$evaluation);
    }
}
