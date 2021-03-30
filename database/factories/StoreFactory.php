<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $random = Str::random(10);
        return [
            "business_name"=>$this->faker->company,
            'bussiness_id'=>$random,
            'country'=>$this->faker->country,
            'city'=>$this->faker->city,
            'address'=>$this->faker->address,
            'lat'=>$this->faker->latitude,
            'lng'=>$this->faker->longitude,
            'is_open'=>true,
            'status'=>'active',
            'user_id'=>$user->id
        ];
    }
}
