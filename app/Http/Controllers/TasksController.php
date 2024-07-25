<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $query= Tasks::where('user_id',auth()->user()->id);
        if($request->category){
            $query=$query->where('category',$request->category);
        }

        if($request->sort_by){
            $order=($request->sort_by == 'oldest')?'ASC':'DESC';
            $query->orderBy('created_at',$order);
        }
        else{
            $query->orderBy('created_at','DESC');

        }
        $data['tasks'] = $query->paginate(8);

        return view('Tasks.index',$data);
    }
    public function create()
    {
        return view('Tasks.create');
    }
    public function store(Request $request) { 

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,completed',
            'category' => 'required|string|in:Urgent,Personal,Work',
            'due_date' => 'nullable|date',
        ]);

        
        Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category' => $request->category,
            'user_id' => Auth::id(),
            'due_date' => $request->due_date,
        ]);
         return redirect()->back()->with('success',"task Added");
               
    }

    public function delete(Tasks $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->back()->with('success',"task Deleted");
 
    }
}
