<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Sprint;

class ProjectController extends Controller
{
    public function index()
    {
        $viewable = ['title','description','url','task_budget'];
        
        $tasks =  Sprint::orderBy('sort_id','ASC')
                          ->get();
        $projects = Project::orderBy('sort_id','ASC')
                            ->get();
        $categories = Category::orderBy('sort_id','ASC')->get();
        return view('project', compact('tasks','categories','projects','viewable'));
    }
}
