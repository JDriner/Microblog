<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFollowerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowSeeder extends Seeder
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
        UserFollowerFactory::new ()
            ->count(20)
            ->create();
    }
}
