<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $dashboardTask=Task::where('user_id', '=', Auth::id())->get();
        $todos=[];
        $completed=[];
        foreach($dashboardTask as $task){
            $dateTime= $task->date;
            $formatDate= date('Y-m-d',strtotime($dateTime));
            $task->date=$formatDate;
            if($task->completed==0){
               array_push($todos,$task);
            }else{
                array_push($completed,$task);
            }
        }
        return view('admin.dashboard',compact('todos','completed'));

    }
}
