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
            'name_employee' => 'kano',
            'username' => 'kasir1',
            'password' => Hash::make('12345678')
        ]);

        Employee::create([
            'outlet_id' => 2,
            'name_employee' => 'dano',
            'username' => 'kasir2',
            'password' => Hash::make('12345678')
        ]);

        customer::create([
            'name' => "agus setiawan",
            'code' => "PTB_0101_01",
            'phone' => "082567472356",
            'address' => "jl.panglima sudirman turen gg.pahlawan.01"
        ]);

        

        Unit::create([
            'satuan' => 'kg'
        ]);

        Unit::create([
            'satuan' => 'liter'
        ]);

        product::create([
            'employee_id' => 1,
            'name_product' => 'semen putih',
            'barcode' => 'SP0457SEK2846',
            'unit_id' => 1,
            'stock' => '30',
            'buy_price' => '45000',
            'selling_price' => '50000',
        ]);

        product::create([
            'employee_id' => 1,
            'name_product' => 'Cat Decolith Putih',
            'barcode' => 'CDP0627SEK7632',
            'unit_id' => 1,
            'stock' => '25',
            'buy_price' => '60000',
            'selling_price' => '70000',
        ]);
    }
}
