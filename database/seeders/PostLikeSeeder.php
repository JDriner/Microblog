<?php

namespace Database\Seeders;

use Database\Factories\PostLikeFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostLikeSeeder extends Seeder
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
            $this->executeSeeder();

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
    public function executeSeeder()
    {
        PostLikeFactory::new ()
            ->count(100)
            ->create();
    }
}
