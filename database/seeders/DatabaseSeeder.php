<?php

namespace Database\Seeders;

use App\Models\PostComment;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserPost;
use App\Models\UserPostComment;
use Database\Factories\UserPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create(
            [
                'name'  => 'Test User',
                'email' => 'test@example.com',
            ]);


        $userPosts = UserPost::factory(20)->create(
            [
                'user_id' => $user->id
            ]);


        foreach($userPosts as $userPost)
        {
            UserPostComment::factory(3)->create(
                [
                    'user_post_id' => $userPost->id,
                ]
            );
        }

    }
}
