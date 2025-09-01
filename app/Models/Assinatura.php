<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    protected $fillable = [
        'id',
        'id_user',
        'texto',
        'hash',
        'assinatura',
        'algoritmo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function logs()
    {
        return $this->hasMany(LogVerificacao::class, 'assinatura_id');
    }
    
}
