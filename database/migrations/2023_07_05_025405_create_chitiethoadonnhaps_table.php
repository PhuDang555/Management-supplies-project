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
        Schema::create('chitiethoadonnhaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hanghoa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nhacungcap_id')->constrained()->cascadeOnDelete();
            $table->integer('soluong');
            $table->bigInteger('dongia');
            $table->date('hansudung');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitiethoadonnhaps');
    }
};
