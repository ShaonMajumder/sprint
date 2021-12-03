<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'class', 'icon', 'color', 'sort_id','project_id'
    ];

    public function project(){
        $this->belongsTo(Project::class);
    }

    public function sprints(){
        $this->hasMany(Sprint::class);
    }
}
