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
        Schema::create('hanghoas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loaihang_id')->constrained()->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('donvitinh');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hanghoas');
    }
};
