<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->integer('nip')->primary();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('pangkat');
            $table->unsignedBigInteger('role');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('pangkat')
                ->references('id_pangkat')
                ->on('pangkat')
                ->onDelete('cascade');

            $table->foreign('role')
                ->references('id_jabatan')
                ->on('jabatan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
