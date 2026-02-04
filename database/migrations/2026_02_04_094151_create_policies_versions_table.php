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
        Schema::create('policies_versions', function (Blueprint $table) {
            $table->id('version_id');
            $table->foreignId('policies_id')->constrained('policies', 'policies_id')->onDelete('cascade');
            $table->string('version_number');
            $table->string('document_path');
            $table->date('effective_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies_versions');
    }
};
