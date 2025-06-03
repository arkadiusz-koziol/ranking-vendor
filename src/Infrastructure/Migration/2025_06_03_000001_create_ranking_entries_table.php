<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ranking_entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('ranking_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('position');
            $table->string('score');
            $table->foreign('ranking_id')->references('id')->on('rankings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ranking_entries');
    }
};
