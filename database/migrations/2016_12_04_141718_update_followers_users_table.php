<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFollowersUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
       {
        Schema::table('followers_users', function (Blueprint $table) {
           $table->renameColumn('user_id','followee_id');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::table('followers_users', function (Blueprint $table) {
           $table->renameColumn('followee_id','user_id');
        });
    }
}
