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
        Schema::create('los', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chitiethoadonnhap_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kho_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(0);
            $table->integer('soluong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('los');
    }
};
