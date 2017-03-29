<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class YahdBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->primary('id');
        });

        Schema::create('priorities', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->primary('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('rank_id')->nullable();
            $table->foreign('rank_id')->references('id')->on('ranks');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->integer('author_id')->nullable();
            $table->integer('priority_id');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('priority_id')->references('id')->on('priorities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('priorities');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rank_id');
        });
        Schema::dropIfExists('ranks');
    }
}
