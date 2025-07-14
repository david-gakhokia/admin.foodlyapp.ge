<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'gakhokia.david@gmail.com'],
            [
                'name' => 'Davit Gakhokia',
                'password' => Hash::make('Paroli_321!'), 
            ]
        );

        $admin->assignRole('admin');
    }
}
