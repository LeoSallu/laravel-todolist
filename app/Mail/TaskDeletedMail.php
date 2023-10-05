<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $task;
    public function __construct(Task $task)
    {
        $this->task=$task;
    }

    public function build()
    {
        $name=$this->task->user->name;
        $taskTitle=$this->task->title;
        $subject = "Your Task '$taskTitle' has been deleted !";
        $body = "Hi $name, your Task $taskTitle has been deleted.";
        return $this->view('mail')
            ->text('mail')
            ->from('todolist@reminder.com')
            ->subject($subject)
            ->with(['body'=>$body]);
    }
}
