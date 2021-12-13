<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishItemPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['item_id' , 'path' , 'index'];

    public function item()
    {
        return $this->belongsTo('App\Models\WishItem');
    }
}
