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
        Schema::table('text_files', function (Blueprint $table) {
            $table->dropForeign(['note_id']);
            $table->foreign('note_id')->references('id')->on('notes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('text_files', function (Blueprint $table) {
            $table->dropForeign(['note_id']);
            $table->foreign('note_id')->references('id')->on('notes');
        });
    }
};
