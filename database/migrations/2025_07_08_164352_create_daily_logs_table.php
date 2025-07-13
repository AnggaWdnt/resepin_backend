<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('daily_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('food_name');
        // PERBAIKAN: Ganti 'decimal' menjadi 'integer'
        $table->integer('portion')->comment('Porsi dalam gram/ml');
        // TAMBAHAN: Kolom baru untuk satuan
        $table->string('unit', 10); // 10 karakter cukup untuk 'gram' atau 'ml'
        $table->date('date');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
