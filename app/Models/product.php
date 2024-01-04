<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function employee () {
        return $this->belongsTo(Employee::class);
    }

    public function unit () {
        return $this->belongsTo(Unit::class);
    }
}
