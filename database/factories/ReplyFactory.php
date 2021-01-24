<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;
    
    public function definition()
    {
    	$topic_ids = Topic::all()->pluck('id')->toArray();
    	$user_ids = User::all()->pluck('id')->toArray();
        return [
            'content' => $this->faker->sentence(),
            'topic_id' => $this->faker->randomElement($topic_ids),
            'user_id' => $this->faker->randomElement($user_ids),
        ];
    }
}
