<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();
        return view('web.task.index' ,[
            'title' => 'Task',
            'tasks' => $tasks
        ]);
            
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'date',
            'description' => 'nullable|string',
            'priority' => 'nullable',
            'status' => 'boolean'
        ]);
    
        $task = Task::create($validator);
        return response()->json(['task' => $task, 'success' => 'Task created successfully']);
    }

    public function update(Request $request, Task $task)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'date',
            'description' => 'nullable|string',
            'priority' => 'nullable',
            'status' => 'boolean',
        ]);

        $task = Task::find($request->id);
        if(blank($task))
        {
            return response()->json([ 'error' => 'record not found']);  
        }
        $task->update($validator);
        return response()->json(['task' => $task, 'success' => 'Task updated successfully']);
    } 
    
    public function destroy($id)
    {
        Task::find($id)->delete();
        return response()->json(['success'=>'Task deleted successfully.']);
    }
    
    
}
