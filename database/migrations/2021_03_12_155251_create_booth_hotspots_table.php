<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booth_hotspots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booth_id');
            $table->string('name')->nullable();
            $table->string('caption')->nullable();
            $table->smallInteger('x')->nullable();
            $table->smallInteger('y')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('booth_id')->references('id')->on('booths')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booth_hotspots');
    }
}
