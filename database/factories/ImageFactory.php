<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Unsplash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->sentence,
            'url' => $this->faker->randomElement(Unsplash::get()->toArray())['download_url'],
        ];
    }
}
