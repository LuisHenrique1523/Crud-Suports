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
        Schema::create('replies_ticket', function (Blueprint $table) {
            $table->uuid('id',36)->primary();
            $table->text('reply');
            $table->timestamps();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies_tickets');
    }
};
