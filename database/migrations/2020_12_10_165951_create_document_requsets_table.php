<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRequsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('department_id');
            $table->foreign('department_id')
                ->references('id')
                ->on('department')
                ->onDelete('cascade');
            $table->foreignId('document_id');
            $table->foreign('document_id')
                ->references('id')
                ->on('documents')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_requests', function (Blueprint $table){
            $table->dropForeign('document_requests_user_id_foreign');
            $table->dropForeign('document_requests_department_id_foreign');
            $table->dropForeign('document_requests_document_id_foreign');
        });
        Schema::dropIfExists('document_requests');
    }
}
