<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;
use App\Models\Link;

class SprintController extends Controller
{
    public function index()
    {
        $links =  Link::orderBy('sort_id','ASC')->get();
        //dd($links->toArray());
        return view('sprint', compact('links'));
    }

    public function updateItems(Request $request)
    {
        $links = Link::all();
        
        foreach ($links as $link) {
            $link->timestamps = false; // To disable update_at field updation
            $id = $link->id;
           
            foreach ($request->order as $order) {
                
                if ($order['id'] == $id) {
                    $link->update(['sort_id' => $order['sort_id']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}
