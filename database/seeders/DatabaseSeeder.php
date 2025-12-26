<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed product categories
        $this->call(ProductCategorySeeder::class);

        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'first_name' => 'Mr',
                'last_name' => 'SiM',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
