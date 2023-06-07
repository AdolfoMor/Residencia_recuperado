<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Direcciones;

class Afiliado extends Model
{
    use HasFactory;
    protected $table = 'afiliado';
    protected $fillable = ['Nombre', 'RFC', 'Dirección', 'Teléfono', 'Logo', 'Descripción'];
    
    public function direcciones(){
        return $this->hasMany(Direcciones::class);
    }

}

