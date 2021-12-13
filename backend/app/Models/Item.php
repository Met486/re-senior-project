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

    const SCRATCH = [
        1 => [ 'label' => 'なし'],
        2 => [ 'label' => '少し傷あり'],
        3 => [ 'label' => '傷あり(読める)'],
        4 => [ 'label' => 'かなり傷あり(読めない)'],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])){
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getScratchLabelAttribute()
    {
        $scratch = $this->attributes['scratches'];

        if(!isset(self::SCRATCH[$scratch])){
            return '';
        }

        return self::SCRATCH[$scratch]['label'];
    }

    public function photos()
    {
        return $this->hasMany('App\Models\ItemPhoto');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
