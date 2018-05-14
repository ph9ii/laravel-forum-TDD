<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        //Disable EventListeners
        Thread::flushEventListeners();
        Reply::flushEventListeners();

        Thread::truncate();
        Reply::truncate();

        // $this->call(UsersTableSeeder::class);
        $this->call(ThreadTableSeeder::class);
        $this->call(ThreadTableSeeder::class);
    }
}
