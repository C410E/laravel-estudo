<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $primaryKey = 'codigo';
    public $timestamps = false;
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'valor', 'quantidade'];
}
