<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_type_id')->constrained('fund_types');
            $table->foreignId('fund_location_id')->constrained('fund_locations');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('overview')->nullable();
            $table->text('bullet')->nullable();
            $table->integer('risk_level_id');
            $table->integer('target_return_start');
            $table->integer('target_return_end');
            $table->boolean('active');
            $table->string('portfolio');
            $table->date('inception_date')->nullable();
            $table->string('distributions');
            $table->string('tax_plan_status');
            $table->string('performance_fee');
            $table->string('minimum_investment');
            $table->string('minimum_subsequent');
            $table->string('liquidity');
            $table->string('redemptions')->nullable();
            $table->string('valuations')->nullable();
            $table->text('pdf_blurb')->nullable();
            $table->integer('risk_rating_id');
            $table->text('pdf_disclaimer')->nullable();
            $table->text('web_disclaimer')->nullable();
            $table->string('nav_frequency');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
