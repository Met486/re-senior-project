<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishEvaluation extends Model
{
    public function wishItems()
    {
        return $this->belongsTo(WishItem::class);
    }

    const STATUS = [
        1 => ['label' => '良い'],
        2 => ['label' => '普通'],
        3 => ['label' => '悪い'],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])){
            return '';
        }
        return self::STATUS[$status]['label'];
    }

    use HasFactory;
}
