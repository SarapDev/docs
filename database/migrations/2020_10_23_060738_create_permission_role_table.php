<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->index()
                ->unsigned();
            $table->foreign('role_id')
                ->references('id')
                ->on('role');
            $table->foreignId('permission_id')
                ->index()
                ->unsigned();
            $table->foreign('permission_id')
                ->references('id')
                ->on('permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
