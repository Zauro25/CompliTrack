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
        Schema::create('audit_reviews', function (Blueprint $table) {
            $table->id('audit_review_id');
            $table->foreignId('compliance_id')->constrained('compliance_entries', 'compliance_id')->onDelete('cascade');
            $table->foreignId('auditor_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->enum('status', ['approved', 'needs_fix']);
            $table->text('notes')->nullable();
            $table->timestamp('reviewed_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_reviews');
    }
};
