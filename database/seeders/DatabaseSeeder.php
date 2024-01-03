<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;
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

        Employee::create([
            'name' => 'kasir rejeni',
            'username' => 'kasir',
            // pw default 12345678
            'password' => Hash::make('12345678')
        ]);

        customer::create([
            'name' => "",
            'phone' => "",
            'address' => ""
        ]);
    }
}
