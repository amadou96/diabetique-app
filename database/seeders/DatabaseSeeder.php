<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'amadoundiaye709@gmail.com'],
            [
                'name'     => 'amadou96',
                'password' => bcrypt('passer1234?'),
                'role'     => 'admin',
            ]
        );
    }
}
