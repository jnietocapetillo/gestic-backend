<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';
    protected $primaryKey = 'idmensaje';

    // mensajes de un usuario específico
    public function usuarios()
    {
        return $this->belongsTo('App\Models\User','id_usuario');
    }

    //saca los mensajes de una incidencia concreta

    public function incidencias()
    {
        return $this->belongsTo('App\Models\incidencia','id_incidencia');
    }

}
