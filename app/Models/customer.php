<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    
    protected $guarded = ['id'];

    public function outlet () {
        return $this->belongsTo(outlet::class, 'outlet_id', 'id');
    }
}
