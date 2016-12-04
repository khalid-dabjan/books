<?php

use Illuminate\Database\Seeder;

class AuthersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Auther::class,100)->create();
    }
}
