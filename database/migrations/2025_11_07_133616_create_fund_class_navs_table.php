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
            $table->decimal('nav');
            $table->decimal('daily_distribution');
            $table->decimal('daily_dividend');
            $table->decimal('percent_change');
            $table->decimal('penny_change');
            $table->integer('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_class_navs');
    }
};
