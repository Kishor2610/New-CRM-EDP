<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\CustomerQuery;

class SendReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerQuery;
    public $solution;


    public function __construct(CustomerQuery $customerQuery, $solution)
    {
        $this->customerQuery = $customerQuery;
        $this->solution = $solution;
    }

    
    public function build()
    {
        return $this->view('customer_query.send_reply')
                    ->subject('Reply to Your Query');
    }
}
