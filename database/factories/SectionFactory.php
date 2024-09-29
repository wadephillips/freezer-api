<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {

        return [
            'name' => 'Lower Left',
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'space_id' => Space::factory(),
        ];
    }
}
