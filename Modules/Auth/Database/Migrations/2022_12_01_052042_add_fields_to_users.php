<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->string('mobile_token')->nullable();
            $table->unsignedTinyInteger('is_blocked')->default(0);
            $table->date('date_of_birth');
            $table->string('instagram_account')->nullable();
            $table->string('club_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['team_id', 'uuid', 'mobile_token']);
        });
    }
};