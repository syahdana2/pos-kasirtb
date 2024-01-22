<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function employee () {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function unit () {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function detail_transaction () {
        return $this->hasMany(detail_transaction::class, 'product_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (!$product->barcode) {
                $productInstance = new Product;
                $product->barcode = $productInstance->generateBarcode($product->name_product, $product->outlet_id);
            }
        });
    }

    public function generateBarcode($productName)
    {

        //dapatkan name produk
        $words = explode(' ', $productName);
        $firstLetters = array_map(function ($word) {
            return strtoupper(substr($word, 0, 1));
        }, $words);
        $cdproduct = implode('', $firstLetters);
        
        // Dapatkan waktu saat ini
        $time = Carbon::now()->format('is');
        
        // Dapatkan nama outlet
        $outlet = Outlet::find(session('outlet_id'));
        $outletName = $outlet->name_outlet;
        $words = explode(' ', $outletName);
        $firstLetters = array_map(function ($word) {
            return strtoupper(substr($word, 0, 1));
        }, $words);
        $cdoutlet = implode('', $firstLetters);

        $randomNumber = rand(1000, 9999);

        //memberikan barcode yang sudah jadi
        $barcode = $cdproduct . $time . $cdoutlet . $randomNumber;
        return $barcode;
    }
    
}
