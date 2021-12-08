<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    

    use HasFactory;
    protected $fillable = [
        'title','user_id'
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

    public function sprints(){
        return $this->hasManyThrough(Sprint::class, Category::class);
    }
}
