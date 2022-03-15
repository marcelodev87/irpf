<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;

    //protected $table = 'file';

    protected $fillable = [
        'year',
        'user_id',
        'updated_at'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function files()
    {
        return $this->hasMany(File::class)->orderBy('id', 'ASC');
    }

    //UPDATED AT -------------------------------------------------
    public function getUpdatedAtAttribute($value)
    {
        // Instância um objeto DateTime passando uma data como parâmetro
        $date = new DateTime($value);
        // Formata a data para exibição
        return $date->format('d/m/Y H:i:s');
    }

    //CREATED AT -------------------------------------------------
    public function getCreatedAtAttribute($value)
    {
        // Instância um objeto DateTime passando uma data como parâmetro
        $date = new DateTime($value);
        // Formata a data para exibição
        return $date->format('d/m/Y H:i:s');
    }

}
