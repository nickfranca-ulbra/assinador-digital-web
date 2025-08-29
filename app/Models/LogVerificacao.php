<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogVerificacao extends Model
{
    protected $fillable = [
        'id',
        'id_assinatura',
        'status',
        'ip',
        'agente'
    ];

    public function assinatura()
    {
        return $this->belongsTo(Assinatura::class, 'id_assinatura');
    }
}
