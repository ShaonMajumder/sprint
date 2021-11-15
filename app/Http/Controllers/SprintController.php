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
