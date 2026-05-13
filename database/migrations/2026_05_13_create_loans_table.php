<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('loan_amount', 12, 2);
            $table->decimal('interest_rate', 5, 2); // Percentage
            $table->decimal('total_payment', 12, 2); // Loan amount + interest
            $table->decimal('monthly_payment', 12, 2);
            $table->integer('loan_term'); // In months
            $table->string('status')->default('pending'); // pending, approved, rejected, paid, overdue
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('rejection_reason')->nullable();
            $table->date('disbursement_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
