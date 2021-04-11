<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueCodeToProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('unique_code')->nullable()->after('audio_thumbnail_url');
            $table->string('unique_id')->nullable()->after('audio_thumbnail_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['unique_code','unique_id']);
        });
    }
}
