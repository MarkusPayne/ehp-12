<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained('funds');
            $table->integer('fund_data_code');
            $table->string('fund_code');
            $table->string('fund_class_name');
            $table->date('inception_date')->nullable();
            $table->string('currency');
            $table->decimal('management_fee');
            $table->decimal('performance_fee');
            $table->decimal('trailer');
            $table->decimal('minimum_initial');
            $table->decimal('minimum_additional');
            $table->boolean('registered_eligible');
            $table->boolean('active');
            $table->integer('sort_order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_classes');
    }
};
