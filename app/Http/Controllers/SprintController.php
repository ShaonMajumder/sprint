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

    public function drag()
    {
        $tasks =  Sprint::orderBy('sort_id','ASC')->get();
        //dd($tasks->toArray());
        return view('drag_and_drop', compact('tasks'));
        
    }

    public function updateItems(Request $request)
    {
        $this->updatePosition($request);
        return response('Updated Position Successfully.', 200);
    }

    /*
    public function updateCategory(Request $request){
        Sprint::where('id', $request->data_id)
                ->update(['category' => $request->category]);
    }
    */

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

    public function populateRow(){
        $tasks = Sprint::select('title','category','description','url')
                        ->orderBy('sort_id','ASC')
                        ->get()
                        ->toArray();
        
        response()->json(  $tasks );
        return response()->json($tasks, 200);

    }
    


}
