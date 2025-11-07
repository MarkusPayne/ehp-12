<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_class_monthly_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_class_monthly_id')->constrained('fund_class_monthlies');
            $table->foreignId('fund_class_monthly_detail_type_id')->constrained('fund_class_monthly_detail_types')->name('fk_fc_monthly_details_type_id');
            $table->string('heading');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_class_monthly_details');
    }
};
