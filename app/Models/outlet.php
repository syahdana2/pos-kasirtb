<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $table = 'outlets';

    protected $guarded = ['id'];
    // protected $filable = ['name_outlet','phone','address']
}
