<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'media' => $this->faker->randomElement([
                'demo1.jpg', 'demo2.jpg', 'demo3.jpg'
            ]), // Assure-toi que ces fichiers existent dans ton dossier public/uploads
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(1),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'status' => $this->faker->randomElement(['active', 'archived']),
            'userId' => User::inRandomOrder()->first()?->id ?? 1,
            'category_id' => Category::inRandomOrder()->first()?->id ?? null,
        ];
    }
}
