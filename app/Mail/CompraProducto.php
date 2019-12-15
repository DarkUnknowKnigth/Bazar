<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompraProducto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $vendedor;
    protected $producto;
    protected $comprador;

    public function __construct($v,$c,$p)
    {
        $this->vendedor=$v;
        $this->comprador=$c;
        $this->producto=$p;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('productos.mail');
    }
}
