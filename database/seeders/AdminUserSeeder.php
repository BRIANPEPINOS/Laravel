<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@blog.test'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'), // cámbialo si quieres
                'role' => 'admin',
            ]
        );
    }
}
