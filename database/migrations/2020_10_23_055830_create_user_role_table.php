<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->index()
                ->unsigned();
            $table->foreignId('role_id')
                ->index()
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('role_id')
                ->references('id')
                ->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
