<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Emails extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->details->tipo==1){
            return $this->subject("Usuario dado de alta en el sistema")
            ->view('mails.email_nuevoUsuario',['datos'=> $this->details]);
        }
        else if($this->details->tipo==2){
            return $this->subject("Usuario Activado")
            ->view('mails.email_activoUsuario',['datos'=> $this->details]);
            
        }
        else if($this->details->tipo==3)
        {
            return $this->subject("Se ha creado una nueva incidencia")
            ->view('mails.email_nuevaIncidencia',['datos'=> $this->details]);
        }
        else if($this->details->tipo==4)
        {
            return $this->subject("Ha recibido un nuevo mensaje en Incidencias")
            ->view('mails.email_nuevoMensaje',['datos'=> $this->details]);
        }
        else if($this->details->tipo== 5)
        {
            return $this->subject("Nuevo correo electrónico")
            ->view('mails.email_envio',['datos'=> $this->details]);
        }
    }
}
