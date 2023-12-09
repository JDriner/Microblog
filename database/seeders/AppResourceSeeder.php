<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppResourceSeeder extends Seeder
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
        // Create a primary user
        $user = UserFactory::new ()
            ->withPosts()
            ->count(1)
            ->create([
                'first_name' => 'Driner',
                'last_name' => 'Familaran',
                'email' => 'dummy1@gmail.com',
            ]);
        
        // Create dummy users
        UserFactory::new ()
            ->withPosts()
            ->count(10)
            ->create();
    }
}
