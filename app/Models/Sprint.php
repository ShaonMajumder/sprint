<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;
    protected $fillable = [
        'sort_id', 'title', 'icon', 'category_id', 'description', 'url'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
