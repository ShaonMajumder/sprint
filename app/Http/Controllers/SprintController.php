<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    public function index()
    {
        $tasks =  Sprint::orderBy('sort_id','ASC')->get();
        //dd($tasks->toArray());
        return view('sprint', compact('tasks'));
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
            'description' => $request->description,
            'url' => $request->url,
            'category' => 'open'
        ]);
        

        $dataArray = $newTask->toArray();
        return response()->json( $dataArray , 200);
    }

    public function updatePosition(Request $request)
    {
        $tasks = Sprint::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;
           
            foreach ($request->order as $order) {
                
                if ($order['id'] == $id) {
                    $task->update([
                        'sort_id' => $order['sort_id'],
                        'category' => $order['category']
                    ]);
                }
            }
        }

        return response('Updated Postions Successfully.', 200);
   
    }
}
