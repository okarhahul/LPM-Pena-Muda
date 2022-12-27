<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postingan>
 */
class PostinganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(mt_rand(2, 10)),
            'slug' => $this->faker->slug(),
            'headline' => $this->faker->paragraph(mt_rand(10, 25)),
            'body' => $this->faker->paragraph(mt_rand(50, 125)),
            'user_id' => (mt_rand(1, 3)),
            'category_id' => (mt_rand(1, 7))
        ];
    }
}
