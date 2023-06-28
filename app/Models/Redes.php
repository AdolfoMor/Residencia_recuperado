<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estructura;

class Redes extends Model
{
    use HasFactory;
    protected $table = 'redes';
    protected $fillable = ['Facebook', 'Instagram', 'Linkedin', 'Twitter', 'Google', 'estructura_id'];

    public function red(){
        return $this->belongsTo(Estructura::class);
    }
}
