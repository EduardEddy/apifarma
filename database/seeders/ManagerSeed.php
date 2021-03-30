<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ManagerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
    }
}
