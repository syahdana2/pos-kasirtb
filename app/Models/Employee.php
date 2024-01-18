<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $guarded = ['id'];

    public function outlet () {
        return $this->belongsTo(outlet::class, 'outlet_id', 'id');
    }

    public function product () {
        return $this->hasMany(Transaction::class, 'employee_id', 'id');
    }

    public function transaction () {
        return $this->hasMany(Transaction::class, 'employee_id', 'id');
    }
}
