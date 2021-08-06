<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientProfileCompleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The client instance
     */
    protected \App\Models\Client $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('info@mariaasensi.com')
                    ->from('info@mariaasensi.com')
                    ->replyTo($this->client->email)
                    ->markdown('emails.clients.profile-completed')
                    ->with([
                        'client' => $this->client
                    ]);
    }
}
