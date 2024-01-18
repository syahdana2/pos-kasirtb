<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $guarded = ['id'];

    public function employee () {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function detail_transaction () {
        return $this->hasMany(detail_transaction::class, 'transaction_id', 'id');
    }
}
