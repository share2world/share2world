<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct ()
    {
        $this->middleware ('auth');
    }

    public function postTask( Request $req ) 
    {
        $task = new Task();
        $user = $req->user();
        $task->uid = $user->id;
        $task->task = $req->task;
        $task->status = 1;
        $task->save();
        return back();
    }

    public function getTask ( Request $req , Task $task)
    {
        $user = $req->user();
        $tasks = $task->where('uid','=',$user->id)->get();
        
        
        return view('home',compact('tasks','user'));
    }

    public function updateTask ( Request $req )
    {

    }


    public function changeStatus( Request $req, $id )
    {
        $task = Task::find($id);
        $task->status = 0;
        if($task->save()){
            return 1;
        }
        return 0;
    }


    public function deleteTask( Request $req, $id) 
    {
        if(Task::destroy($id)){
            return 1;
        }
        return 0;
    }


}
