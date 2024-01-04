<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use App\Models\outlet;
use App\Models\product;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::create([
            'username' => 'admin',
            // pw default 12345678
            'password' => Hash::make('12345678')
        ]);

        outlet::create([
            'name_outlet' => 'Surya Kencana Enak',
            'phone' => '082278459821',
            'address' => 'Malang',
        ]);

        outlet::create([
            'name_outlet' => 'Bagong',
            'phone' => '082178562984',
            'address' => 'Malang',
        ]);

        Employee::create([
            'outlet_id' => 1,
            'name_employee' => 'nako',
            'username' => 'kasir',
            // pw default 12345678
            'password' => Hash::make('12345678')
        ]);

        customer::create([
            'name' => "agus setiawan",
            'code' => "PTB_0101_01",
            'phone' => "082567472356",
            'address' => "jl.panglima sudirman turen gg.pahlawan.01"
        ]);

        Employee::create([
            'outlet_id' => 2,
            'name_employee' => 'nado',
            'username' => 'kasir1',
            // pw default 12345678
            'password' => Hash::make('12345678')
        ]);

        Product::create([
            'employee_id' => 1,
            'unit_id' => 1,
            'name_product' => 'Semen',
            'barcode' => 'S_001',
            'stock' => '4',
            'selling_price' => 50000,
            'buy_price' => 55000,
            'image' => 'profile2.jpg',
            'desc' => 'semen gresik 50 kg'
        ]);

        Product::create([
            'employee_id' => 2,
            'unit_id' => 1,
            'name_product' => 'Semen',
            'barcode' => 'S_002',
            'stock' => '10',
            'selling_price' => 50000,
            'buy_price' => 55000,
            'image' => 'profile2.jpg',
            'desc' => 'semen gresik 50 kg'
        ]);

        Unit::create([
            'satuan' => 'kg'
        ]);

        Unit::create([
            'satuan' => 'liter'
        ]);
    }
}
