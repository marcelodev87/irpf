<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'date_of_birth',
        'description',
        'comment',
        'declaration_id'
    ];

    // DOCUMENT --------------------------------------------------
    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = $this->clearField($value);
    }

    public function getDocumentAttribute($value)
    {
        return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
    }

    // DATE OF BIRTH -----------------------------------------
    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $this->convertStringToDate($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    //UPDATED AT -------------------------------------------------
    public function getUpdatedAtAttribute($value)
    {
        // Instância um objeto DateTime passando uma data como parâmetro
        $date = new DateTime($value);
        // Formata a data para exibição
        return $date->format('d/m/Y H:i:s');
    }

    // PRIVATE FUNCTIONS ------------------------------------
    private function convertStringToDouble(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        list($day, $month, $year) = explode('/', $param);
        return (new DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    private function clearField(?string $param)
    {
        if (empty($param)) {
            return '';
        }
        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
