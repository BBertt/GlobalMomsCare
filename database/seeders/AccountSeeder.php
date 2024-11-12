<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Account::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => 'admin',
            'role' => 'admin',
            'description' => $faker->sentence(),
            'address' => $faker->address(),
        ]);
        Account::factory()->count(5)->create();
    }
}
