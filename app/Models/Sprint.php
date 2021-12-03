<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;
    protected $fillable = [
        'sort_id', 'title', 'icon', 'category', 'description', 'url'
    ];

    public function category(){
        $this->belongsTo(Category::class);
    }
}
