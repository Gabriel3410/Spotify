<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'manager@gmail.com'], //vcerifica se o email já existe

            [
                'name' => 'Manager',
                'password' => Hash::make('senha123'),
                'is_manager' => true,
            ],
        );
    }
}
