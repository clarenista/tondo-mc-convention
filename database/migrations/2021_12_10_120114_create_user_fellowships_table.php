<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFellowshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fellowships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('registrant_id');
            $table->string('webinar_id');
            $table->string('topic');
            $table->string('role');
            $table->mediumText('join_url');
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
        Schema::dropIfExists('user_fellowships');
    }
}
