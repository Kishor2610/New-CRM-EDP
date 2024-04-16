<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Dompdf\Dompdf;
use Dompdf\Options;

use PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;


class InvoiceMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $sales;
    public $totalAmount;
    

    public function __construct($invoice, $sales, $totalAmount)
    {
        $this->invoice = $invoice;
        $this->sales = $sales;
        $this->totalAmount = $totalAmount;
    }

    // public function build()
    // {
    //     $subject = "Your Invoice";

    //     return $this->subject($subject)
    //                 ->view('invoice.show');
    // }

    public function build()
    {
        $subject = "Invoice";

        return $this->subject($subject)
                    ->from('crm@example.com', 'CRM') 
                    ->view('invoice.mail');
    }


 

 




}
