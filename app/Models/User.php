<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'password',
        'chave_privada',
        'chave_publica',
    ];

    public function assinaturas()
    {
        return $this->hasMany(Assinatura::class, 'user_id');
    }
}
