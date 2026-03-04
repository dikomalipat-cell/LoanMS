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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('address');
            $table->date('birthdate')->nullable()->after('gender');
            $table->integer('age')->nullable()->after('birthdate');
            $table->string('police_records')->nullable()->after('age');
            $table->string('current_job')->nullable()->after('police_records');
            $table->decimal('payroll', 10, 2)->nullable()->after('current_job');
            $table->string('payroll_picture')->nullable()->after('payroll');
            $table->unsignedBigInteger('admin_id')->nullable()->after('payroll_picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn([
                'gender',
                'birthdate',
                'age',
                'police_records',
                'current_job',
                'payroll',
                'payroll_picture',
                'admin_id',
            ]);
        });
    }
};
