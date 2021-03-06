<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'document_voter',
        'date_of_birth',
        'civil_status',
        'occupation',

        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',

        'telephone',
        'cell',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function banks()
    {
        return $this->hasOne(Bank::class, 'user_id', 'id');
    }

    public function declarations()
    {
        return $this->hasMany(Declaration::class, 'user_id', 'id');
    }

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
        // Inst??ncia um objeto DateTime passando uma data como par??metro
        $date = new DateTime($value);
        // Formata a data para exibi????o
        return $date->format('d/m/Y H:i:s');
    }

    //CREATED AT -------------------------------------------------
    public function getCreatedAtAttribute($value)
    {
        // Inst??ncia um objeto DateTime passando uma data como par??metro
        $date = new DateTime($value);
        // Formata a data para exibi????o
        return $date->format('d/m/Y H:i:s');
    }

    // ZIPCODE --------------------------------------------------
    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = $this->clearField($value);
    }

    public function getZipcodeAttribute($value)
    {
        return substr($value, 0, 5). '-' . substr($value, 5, 3);
    }

    // PHONE AND CELL --------------------------------------------------
    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = $this->clearField($value);
    }

    public function getTelephoneAttribute($value)
    {
        return '(' . substr($value, 0, 2) . ') '. substr($value, 2, 4) . '-' . substr($value, 6, 5);
    }

    public function getCellAttribute($value)
    {
        return '(' . substr($value, 0, 2) . ') '. substr($value, 2, 4) . '-' . substr($value, 6, 5);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = $this->clearField($value);
    }

    // PRIVATE FUNCTIONS ------------------------------------
    private function convertStringToDouble(?string $param)
    {
        if(empty($param)){
            return null;
        }
        return str_replace(',' , '.' , str_replace('.', '', $param));
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }
        list($day,$month,$year) = explode('/', $param);
        return (new DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    private function clearField(?string $param)
    {
        if(empty($param)){
            return '';
        }
        return str_replace(['.','-','/','(',')',' '], '', $param);
    }
}
