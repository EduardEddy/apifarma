<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Store::factory(3)->create();
    }
}
