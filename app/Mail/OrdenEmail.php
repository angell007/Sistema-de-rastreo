<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdenEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $clausulas, $empresa)
    {
        $this->order = $order;
        $this->clausulas = $clausulas;
        $this->empresa = $empresa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $clausulas = $this->clausulas;
        $empresa = $this->empresa;
        return $this->subject('Detalles de orden')
            ->view('admin.orders.envio', compact('order', 'clausulas', 'empresa'));
    }
}
