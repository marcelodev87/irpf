<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'file';

    protected $fillable = [
        'description',
        'path',
        'created_at',
        'updated_at'
    ];

    public function declaration()
    {
        return $this->belongsTo(Declaration::class);
    }

    //UPDATED AT -------------------------------------------------
    public function getCreatedAtAttribute($value)
    {
        // Instância um objeto DateTime passando uma data como parâmetro
        $date = new DateTime($value);
        // Formata a data para exibição
        return $date->format('d/m/Y H:i:s');
    }
}
