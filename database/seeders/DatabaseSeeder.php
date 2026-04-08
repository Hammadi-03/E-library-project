<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Abdulaziz',
                'role' => 'admin',
                'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            ]
        );

        $this->call([
            BookSeeder::class,
        ]);
    }
}
