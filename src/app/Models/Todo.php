<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'content'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function scopeCategorySearch($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        return $query->where('content', 'like', '%' . $keyword . '%');
    }
}
