<?php

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private readonly Notification $notification)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $post = $this->notification->post;
        return $this
            ->from('test@localhost')
            ->view('emails.posts.created')
            ->with(['postTitle' => $post->title, 'postDescription' => $post->description]);
    }
}
