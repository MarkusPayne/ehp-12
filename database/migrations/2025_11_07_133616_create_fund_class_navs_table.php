<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_class_navs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_class_id')->constrained('fund_classes');
            $table->date('nav_date');
            $table->decimal('nav', 10, 4);
            $table->decimal('daily_distribution', 10, 4);
            $table->decimal('daily_dividend', 10, 4);
            $table->decimal('percent_change', 10, 4);
            $table->decimal('penny_change', 10, 4);
            $table->integer('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_class_navs');
    }
};
