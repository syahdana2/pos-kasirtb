<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    
    protected $table = 'units';

    protected $guarded = ['id'] ;

    function product () {
        return $this->hasMany(Product::class, 'unit_id', 'id');
    }
}
