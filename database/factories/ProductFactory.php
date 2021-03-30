<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $store = Store::inRandomOrder()->first();
        return [
            'name'=>$this->faker->title,
            'description'=>$this->faker->text,
            'components'=>$this->faker->text,
            'active'=>true,
            'cant'=>$this->faker->randomNumber(1).'mm',
            'price'=>$this->faker->randomNumber(2),
            'store_id'=>$store->id,
            'user_created_id'=>$user->id
        ];
    }
}
