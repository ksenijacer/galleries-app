<?php

namespace Database\Factories;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImageFactory extends Factory
{
     protected $model = Image::class;

     public function definition()
     {
         return [
             'url' => $this->faker->imageUrl(360, 360, 'gallery'),
             'gallery_id' => Gallery::inRandomOrder()->first(),
         ];
     }
 }
