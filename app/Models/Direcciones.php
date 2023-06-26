<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliado;

class Direcciones extends Model
{
    use HasFactory;
    protected $table = 'direcciones';
    protected $fillable = ['Estado', 'Ciudad', 'Calle', 'Colonia', 'Numero', 'Telefono', 'afiliado_id'];
    
    public function afil(){
        return $this->belongsTo(Afiliado::class);
    }
    
}
