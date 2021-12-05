<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Sprint;
use App\Http\Controllers\SprintController;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $viewable = ['title','description','url','task_budget','rating'];
        $request['viewable'] = $viewable;

        if(!$request->get('title')){
            
        
            $tasks =  Sprint::orderBy('sort_id','ASC')
                            ->get();
            $projects = Project::orderBy('sort_id','ASC')
                                ->get();
            $categories = Category::orderBy('sort_id','ASC')->get();
            return view('project', compact('tasks','categories','projects','viewable'));
        }else{
            return SprintController::index($request);
        }
        

        
    }
}
