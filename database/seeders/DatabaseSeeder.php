<?php

namespace Database\Seeders;

use App\Models\{Question, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'José Neto',
            'email' => 'jose@sfalsim.com.br',
        ]);

        Question::factory()->count(10)->create();
    }
}
