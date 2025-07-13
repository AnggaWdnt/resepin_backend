<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('daily_logs', function (Blueprint $table) {
        $table->foreignId('food_id')->nullable()->constrained('foods')->onDelete('cascade');
    });
}
public function down()
{
    Schema::table('daily_logs', function (Blueprint $table) {
        $table->dropForeign(['food_id']);
        $table->dropColumn('food_id');
    });
}

};
