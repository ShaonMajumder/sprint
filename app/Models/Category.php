<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    public function store(Request $request)
    {   
        
        $newCategory = Category::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'color' => $request->color
        ]);
        

        $dataArray = $newCategory->toArray();
        return response()->json( $dataArray , 200);
    }
}
