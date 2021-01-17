<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $sentence = $this->faker->sentence();
        $userIds = User::all()->pluck('id')->toArray(); 
        $categoryIds = Category::all()->pluck('id')->toArray(); 
        return [
            'title' => $sentence,
            'body' => $this->faker->text(),
            'excerpt' => $sentence,
            'user_id' => $this->faker->randomElement($userIds),
            'category_id' => $this->faker->randomElement($categoryIds),
        ];
    }
}
