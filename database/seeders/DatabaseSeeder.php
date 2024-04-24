<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'id' => '1',
            'username' => 'Anonymous',
            'nama_lengkap' => 'Anonymous',
        ]);
        User::create([
            'id' => '2',
            'username' => 'indi',
            'nama_lengkap' => 'Indi Nur Hidayati',
            'alamat' => 'Ligung',
            'email' => 'indinurhidayati91@gmail.com',
            'password' => '12345678'
        ]);
        User::create([
            'id' => '3',
            'username' => 'maryam',
            'nama_lengkap' => 'Maryam',
            'alamat' => 'Ligung',
            'email' => 'maryam@gmail.com',
            'password' => '12345678'
        ]);
    }
}
