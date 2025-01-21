<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('email', 'admin@admin.com')->delete();
        User::create([
            'email' => 'admin@yopmail.com',
            'name' => 'Admin',
            'type' => '0',
            'password' => Hash::make('Admin@1234')
        ]);
    }
}
