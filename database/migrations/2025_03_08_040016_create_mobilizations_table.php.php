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
        Schema::create('mobilizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('job_order_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->string('position')->nullable();
            $table->integer('req_no')->nullable();
            $table->integer('total_cv')->nullable();
            $table->integer('bal_req_cv')->nullable();
            $table->string('handle_by')->nullable();
            $table->date('deadline')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
