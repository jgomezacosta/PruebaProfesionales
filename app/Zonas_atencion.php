<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonas_atencion extends Model
{
    //
    public $table = "zonas_atencion";

    public function profesionales()
    {
        return $this->hasMany(Profesionales::class, 'zona_atencion_id', 'id');
    }
}
