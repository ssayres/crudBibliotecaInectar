<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'editora',
        'ano',
        'quantidade',
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
