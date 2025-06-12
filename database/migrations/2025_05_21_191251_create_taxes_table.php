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
        Schema::create('taxes', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
// Suggested code may be subject to a license. Learn more: ~LicenseLog:3755947523.
            $table->string('type')->nullable();
            $table->decimal('value', 8, 2)->nullable();
            $table->date('due_date')->nullable();
            $table->date('competence_month')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
