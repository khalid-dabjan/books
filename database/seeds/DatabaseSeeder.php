<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    protected $toTruncate = ['books'];

    public function run() {
        
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
            // $this->call(UsersTableSeeder::class);
            $this->call(BooksTableSeeder::class);
        
    }

}
