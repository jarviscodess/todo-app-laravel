<?php

namespace TodoApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use TodoApp;

class TaskController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$tasks= TodoApp\Tasks::getAll();
        $doneTasks = TodoApp\Tasks::getDoneTasks();
        

        return view('home', array(
            'tasks' => $tasks,
            'doneTasks' => $doneTasks
        ));
    }

    public function create()
    {
        $userID = auth()->id();

        $task = new TodoApp\Tasks;
        $task->owner = $userID; 
        $task->description = Input::get('description');
        $task->status = 0;
        $task->save();

        return response()->json([
            'response' => 'success',
            'msg' => 'Todo wurde erstellt',
            'task_id' => $task->id
        ]);
    }

    public function complete($task_id)
    {
        $userID = auth()->id();

        $task = TodoApp\Tasks::find($task_id);

        if ($task) {
            if ( $task->owner === $userID ) {
                $task->status = 1;
                $task->save();
                return response()->json([
                    'response' => 'success',
                    'msg' => 'Aufgabe erledigt!',
                    'task_id' => $task->id
                ]);
            }
        } else {
            return response()->json([
                'response' => 'error',
                'msg' => 'Etwas ist schief gelaufen!',
                'task_id' => $task->id
            ]);
        }
    }

    public function delete($task_id)
    {
        $userID = auth()->id();

        $task = TodoApp\Tasks::find($task_id);

        if ($task) {
            if ( $task->owner === $userID ) {
                $task->delete();
                return response()->json([
                    'response' => 'success',
                    'msg' => 'Aufgabe wurde gelöscht!',
                ]);
            }
        } else {
            return response()->json([
                'response' => 'error',
                'msg' => 'Etwas ist schief gelaufen!',
            ]);
        }
    }

}
