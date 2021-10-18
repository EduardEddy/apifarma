<?php

namespace Database\Factories;

use App\Models\AddressUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'city'=>$this->faker->city,
            'country'=>$this->faker->country,
            'address'=>$this->faker->address,
            'lat'=>$this->faker->latitude,
            'lng'=>$this->faker->longitude,
            'user_id'=>$user->id,
            'select'=>true
        ];
    }
}
