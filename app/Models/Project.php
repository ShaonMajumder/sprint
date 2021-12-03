<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    /**
     * Get the user that owns the project
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}