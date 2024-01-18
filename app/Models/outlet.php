<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $table = 'outlets';

    protected $guarded = ['id'];
    
    function employee () {
        return $this->hasMany(Employee::class, 'outlet_id', 'id');
    }
}
