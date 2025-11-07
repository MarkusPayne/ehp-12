<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained('funds');
            $table->foreignId('document_type_id')->constrained('document_types');
            $table->string('language');
            $table->string('document_name');
            $table->string('file_name');
            $table->boolean('edit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_documents');
    }
};
