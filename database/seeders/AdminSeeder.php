<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ouijdane',
            'email' => 'ouijdane@gmail.com',
            'password' => bcrypt('wijwij'),
            'role' => 'administrator'
        ]);
    }
}
