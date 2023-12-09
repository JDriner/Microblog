<?php

namespace Database\Seeders;

use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $count = 50;
            $this->executeSeeder($count);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
    /**
     * Execute the defined seeders
     *
     * @return void
     */
    public function executeSeeder($count)
    {            
        PostFactory::new()->originalPost()
            ->count(10)
            ->withComments()
            ->create();

        for ($i = 0; $i < $count; $i++) {
            $post = Post::inRandomOrder()->first();

            PostFactory::new ()
                ->count(1)
                ->state([
                    'post_id' => $post ? $post->id : null,
                    'image' => null,
                ])
                ->create();
        }
    }
}
