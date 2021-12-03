<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sprint;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    public function index()
    {
        $viewable = ['title','description','url','task_budget'];
        
        $tasks =  Sprint::orderBy('sort_id','ASC')
                          ->get();
        $categories = Category::orderBy('sort_id','ASC')->get();
        return view('sprint', compact('tasks','categories', 'viewable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $newTask = Sprint::create([
            'title' => $request->title,
            'category' => ($request->category) ? $request->category : env('DEFAULT_CATEGORY_NAME'),
            'description' => $request->description,
            'url' => $request->url,
        ]);
        $newTask = Sprint::where('url', $newTask->url)->first();
        $dataArray = $newTask->toArray();
        return response()->json( $dataArray , 200);
    }

    public function updatePosition(Request $request)
    {
        foreach ($tasks as $task) {
            foreach ($request->order as $order) {
                $task = Sprint::find($order['id']);
                $task->timestamps = false; // To disable update_at field updation
                $task->update([
                    'sort_id' => $order['sort_id'],
                    'category' => $order['category']
                ]);    
            }
        }
        return response('Updated Postions Successfully.', 200);
    }

    public function getCategories(Request $request){
        $categories = Category::orderBy('sort_id','ASC')->get();
        $dataArray = $categories->toArray();
        return response()->json( $dataArray , 200);
    }
}
