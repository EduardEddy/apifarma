<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AddressUser::factory(4)->create();
    }
}
