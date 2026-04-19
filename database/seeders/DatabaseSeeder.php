<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->create([
            'name' => 'Administrator',
            'email' => 'admin@library.test',
            'password' => 'password',
        ]);

        Member::query()->create([
            'member_code' => 'AGT001',
            'name' => 'Anggota Demo',
            'email' => 'anggota@library.test',
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'password' => 'password',
        ]);

        Book::query()->insert([
            [
                'code' => 'BK001',
                'title' => 'Laravel untuk Pemula',
                'publish_year' => 2024,
                'author' => 'Tim Empore',
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BK002',
                'title' => 'Pemrograman PHP Modern',
                'publish_year' => 2023,
                'author' => 'Open Source ID',
                'stock' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
