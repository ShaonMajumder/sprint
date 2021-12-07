<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;

class CategoryController extends Controller
{
    public function store(Request $request)
    {   
        $newCategory = Category::create([
            'project_id' => Project::where('title', $request->project_title )->first()->id,
            'title' => $request->title,
            'class' => $request->class,
            'icon' => $request->icon,
            'color' => $request->color,
            'sort_id' => Category::max('sort_id') + 1
        ]);
        

        $dataArray = $newCategory->toArray();
        return response()->json( $dataArray , 200);
    }
}
