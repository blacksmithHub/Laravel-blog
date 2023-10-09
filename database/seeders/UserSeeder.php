<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->hasPosts()->count(5)->create();
        User::factory()
            ->has(
                Post::factory()
                    ->count(5)
                    ->has(
                        Comment::factory()->count(3)
                    )
            )
            ->count(5)
            ->create();
    }
}
