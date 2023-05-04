<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_address_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->unique(['key', 'branch_id'], 'branch_settings_unique');
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
        Schema::dropIfExists('branch_address_settings');
    }
};
