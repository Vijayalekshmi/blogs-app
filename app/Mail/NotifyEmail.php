<?php
 
namespace App\Mail;
 
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class NotifyEmail extends Mailable
{
    use Queueable, SerializesModels;
 
  
 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function __construct(Post $post,User $doneByUser,string $activity,string $details='')
    {
        $this->post = $post;
        $this->doneByUser = $doneByUser;
        $this->activity = $activity;
        $this->details = $details;



    }
    
 
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
 

    public function build()
    {
        return $this->view('emails.activity')
                    ->subject('You have a new '.$this->activity)
                    ->with([
                        'post' => $this->post,
                        'doneByUser' =>$this->doneByUser,
                        'activity' =>$this->activity,
                        'details' => $this->details 
                    ]);
    }

   
}