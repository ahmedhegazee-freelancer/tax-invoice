<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('send_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('branch_name');
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_prod')->default(false);
            $table->longText('data');
            $table->dateTime('date');
            $table->timestamps();
            $table->unique(['ticket_id', 'is_prod']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_invoices');
    }
};