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
        Schema::create('branch_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->string('device_serial_number');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('pos_os_version');
            $table->boolean('is_prod')->default(false);
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
        Schema::dropIfExists('branches');
    }
};