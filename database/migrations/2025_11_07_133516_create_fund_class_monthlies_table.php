<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_class_monthlies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_class_id')->constrained('fund_classes');
            $table->date('date');
            $table->decimal('nav');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_class_monthlies');
    }
};
