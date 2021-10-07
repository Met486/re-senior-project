<?php

namespace App\Models;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getLists()
    {
        $categories = Category::pluck('category_name','id');

        return $categories;
    }

    public function products()
    {
        return $this->hasMany(Item::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getLftName()
    {
        return '_lft';
    }
    
    public function getRgtName()
    {
        return '_rgt';
    }
    
    // public function getParentIdName()
    // {
    //     return 'parent_';
    // }
    
    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'depth',
    ];

    use HasFactory;
    use NodeTrait;
}
