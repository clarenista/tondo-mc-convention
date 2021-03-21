<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPanoramaLocationAndZToTableBooths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booths', function (Blueprint $table) {
            $table->string('panorama_location')->nullable();
            $table->float('z')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booths', function (Blueprint $table) {
            //
        });
    }
}
