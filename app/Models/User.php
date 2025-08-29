<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'email',
        'chave_privada',
        'chave_publica'
    ];

    public function assinaturas()
    {
        return $this->hasMany(Assinatura::class, 'user_id');
    }

}
