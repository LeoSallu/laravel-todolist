<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TaskCreatedMail extends Mailable
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

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        $name=$this->task->user->name;
        $subject = 'New Task created !';
        $body = "Hi '$name', a new task has been created.";
        return $this->view('mail')
            ->text('mail')
            ->from('todolist@reminder.com')
            ->subject($subject)
            ->with(['mailMessage' => $this->task,'body'=>$body]);
    }
}
