<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    use HasFactory;
    protected $table = 'direcciones';
    protected $fillable = ['Dirección', 'afiliado_fk'];
    
    public function afil(){
        return $this->belongsTo(Afiliado::class);
    }
    
}
