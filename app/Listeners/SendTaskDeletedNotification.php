<?php

namespace App\Listeners;

use App\Events\TaskDeleted;
use App\Mail\TaskDeletedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskDeletedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TaskDeleted  $event
     * @return void
     */
    public function handle(TaskDeleted $event)
    {
        $email=$event->task->user;
        Mail::to($email)->send(new TaskDeletedMail($event->task));
    }
}
