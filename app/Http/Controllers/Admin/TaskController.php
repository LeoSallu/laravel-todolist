<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Jobs\MailCreateJob;
use App\Jobs\MailDeleteJob;
use App\Jobs\MailUpdateJob;
use App\Mail\TaskCreatedMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', '=', Auth::id())->get();
        foreach($tasks as $task){
            $dateTime= $task->date;
            $formatDate= date('Y-m-d',strtotime($dateTime));
            $task->date=$formatDate;
    
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $newTask = new Task();
        $newTask->fill($data);
        $newTask->user_id=Auth::id();
        $newTask->save();
        dispatch(new MailCreateJob($newTask));
        // $email=($newTask->user->email);
      
        // if(is_string($email)){
        //     Mail::to($email)->send(new TaskCreatedMail($newTask));
        // }
        // else{
        //     dd('non è una stringa');
        // }
        return redirect()->route('admin.task.show',$newTask->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $dateTime= $task->date;
        $formatDate= date('Y-m-d',strtotime($dateTime));
        $task->date=$formatDate;
        if ($task->user_id == Auth::user()->id) {

            return view('admin.tasks.show', compact('task'));
        }
        else redirect()->route('admin.task.index')->withErrors("Task not found");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if ($task->user_id == Auth::user()->id) {
            return view('admin.tasks.edit',compact('task'));
        } else redirect()->route('admin.task.index')->withErrors("Task not found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $taskSelected = $task->title;
        $data = $request->validated();
        $task->update($data);
        $task->save();
        // event(new TaskUpdated($task));
        dispatch(new MailUpdateJob($task));
        return redirect()->route('admin.task.show',$task->id)->with('message', "The task '$taskSelected' has been edit successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $taskSelected = $task->title;
        $task->delete();
        // event(new TaskDeleted($task));
        dispatch(new MailDeleteJob($task));
        return redirect()->route('admin.task.index')->with('message', "Task $taskSelected has been deleted successfully ");
    }
}
