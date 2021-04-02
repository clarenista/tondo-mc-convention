<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_messages', function (Blueprint $table) {
            $table->string('interest')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('user_id');
            $table->string('mobile_number')->nullable()->after('user_id');
            $table->string('affiliation')->nullable()->after('user_id');
            $table->string('name')->nullable()->after('user_id');
            $table->string('subject')->nullable()->after('user_id');
            $table->foreignId('booth_id')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_messages', function (Blueprint $table) {
            $table->dropColumn(['interest','email','mobile_number','affiliation','name','subject','booth_id']);
        });
    }
}
