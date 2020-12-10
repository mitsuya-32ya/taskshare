<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $auth_user = auth()->user();
        $timelines = $task->getTimelines();

        return view('tasks.index', [
            'auth_user' => $auth_user,
            'timelines' => $timelines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user = auth()->user();

        return view('tasks.create', [
            'auth_user' => $auth_user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $auth_user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'task_name' => ['required','string','max:50'],
            'due_date' => ['required','after:yesterday']
        ]);

        $validator->validate();
        $task->taskStore($auth_user->id,$data);

        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Comment $comment)
    {
        $user = auth()->user();
        $task = $task->getTask($task->id);
        $comments = $comment->getComments($task->id);

        return view('tasks.show', [
            'user' => $user,
            'task' => $task,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $auth_user = auth()->user();
        $edit_task = $task->getEditTask($auth_user->id, $task->id);

        if(!isset($edit_task)){
            return redirect('tasks');
        }

        return view('tasks.edit', [
            'auth_user' => $auth_user,
            'edit_task' => $edit_task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'task_name' => ['required','string','max:50'],
            'due_date' => ['required','after:yesterday'],
            'status' =>['required','in:1,2']
        ]);

        $validator->validate();
        $task->taskUpdate($task->id,$data);

        return redirect('users/'. auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->taskDestroy(auth()->user()->id, $task->id);
        return back();
    }
}
