<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    public $visible = [
        'id',
        'name',
        'width',
        'height',
        'is_basis',
        'svg'
    ];
}
