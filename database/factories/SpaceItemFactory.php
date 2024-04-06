<?php

namespace Database\Factories;

use App\Models\SpaceItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SpaceItemFactory extends Factory
{

    protected $model = SpaceItem::class;

    public function definition(): array
    {

        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'space_id' => $this->faker->randomNumber(),
            'item_id' => $this->faker->randomNumber(),
            'quantity' => $this->faker->word(),
            'order' => $this->faker->randomNumber(),
        ];
    }

}
