<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishItem extends Model
{
    const SCRATCH = [
        1 => [ 'label' => 'なし'],
        2 => [ 'label' => '少し傷あり'],
        3 => [ 'label' => '傷あり(読める)'],
        4 => [ 'label' => 'かなり傷あり(読めない)'],
    ];

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
        return $this->hasMany('App\Models\WishItemPhoto');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
