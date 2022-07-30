<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Gallery;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'user_id' => User::all()->random()->id,
            'gallery_id' => Gallery::all()->random()->id,
            'created_at' => $this->faker->dateTimeThisDecade('now', 'Europe/Belgrade'),
        ];
    }
}
