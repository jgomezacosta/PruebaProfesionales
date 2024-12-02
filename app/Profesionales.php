<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesionales extends Model
{
    //
    public $table = "profesionales";
    
    // Declaro los campos que usaré de la tabla 'profesionales' 
    //protected $fillable = ['nombre', 'precio', 'stock', 'img'];

    public function zonaAtencion()
    {
        return $this->belongsTo(Zonas_atencion::class, 'zona_atencion_id', 'id');
    }
}
