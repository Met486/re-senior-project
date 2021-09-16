<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    const STATUS = [
        1 => [ 'label' => '出品中', 'class' => 'label-info'],
        2 => [ 'label' => '売り切れ', 'class' => 'label-danger'],
        3 => [ 'label' => '取引中', 'class' => ''],
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
