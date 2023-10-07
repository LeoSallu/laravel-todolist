<?php

namespace App\Jobs;

use App\Mail\TaskCreatedMail;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $task;
    public function __construct(Task $task)
    {
        $this->task=$task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email=$this->task->user->email;
        Mail::to($email)->send(new TaskCreatedMail($this->task));
    }
}
