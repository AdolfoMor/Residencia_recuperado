<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Redes;

class Estructura extends Model
{
    use HasFactory;
    protected $table = 'estructura';
    protected $fillable = ['Nombre', 'Posicion', 'Foto'];

    public function redes(){
        return $this->hasMany(Redes::class);
    }
}
