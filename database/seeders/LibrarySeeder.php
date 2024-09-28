<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Library information
        $libraries = [
            ['name' => 'Merkez Kütüphane', 'location' => 'İstanbul'],
            ['name' => 'Kütüphane A', 'location' => 'İstanbul'],
            ['name' => 'Kütüphane B', 'location' => 'Bursa'],
        ];

        // Add library information to database
        foreach ($libraries as $library) {
            Library::create($library);
        }
    }
}
