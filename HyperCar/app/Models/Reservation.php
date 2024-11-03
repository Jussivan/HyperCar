<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'IdUsuario');
    }
    
    public function car() {
        return $this->belongsTo(Car::class, 'IdCarro');
    }
    
}
