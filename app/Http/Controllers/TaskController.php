<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where("iscompleted", false)->orderBy("id", "ASC")->get();
        $completed_tasks = Task::where("iscompleted", true)->get();
        return view("todo", compact("tasks", "completed_tasks"));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $task = new Task();
        $task->task = request("task");
        $task->save();
        return Redirect::back()->with("message", "Task has been added");
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return Redirect::back()->with('url', "{$id}/save")
            ->with('taskText', $task->task);
    }

    public function save($id, Request $request)
    {
        $task = Task::find($id);
        $task->task = $request->input('task');
        $task->save();
        return Redirect::back()->with("message", "Task has been saved");
    }

    public function complete($id)
    {
        $task = Task::find($id);
        $task->iscompleted = true;
        $task->save();
        return Redirect::back()->with("message", "Task has been added to completed list");
    }

    public function uncompleted($id)
    {
        $task = Task::find($id);
        $task->iscompleted = false;
        $task->save();
        return Redirect::back()->with("message", "Task has been changed to uncompleted list");
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::back()->with('message', "Task has been deleted");
    }
}
