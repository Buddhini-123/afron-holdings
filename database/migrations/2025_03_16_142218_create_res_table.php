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
        Schema::create('res', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->date('handover_date')->nullable();
            $table->string('position')->nullable();
            $table->string('job_order_no')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('sub_agent_id')->nullable();
            $table->string('re_coordinator')->nullable();
            $table->string('handover')->nullable();
            $table->boolean('cv')->nullable();
            $table->boolean('pp')->nullable();
            $table->boolean('pp_size_pic')->nullable();
            $table->boolean('bcc')->nullable();
            $table->boolean('ppt_copy')->nullable();
            $table->boolean('licensed_copy')->nullable();
            $table->boolean('police_report')->nullable();
            $table->boolean('working_video')->nullable();
            $table->boolean('myself_video')->nullable();
            $table->boolean('education_cert')->nullable();
            $table->boolean('other_cert')->nullable();
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res');
    }
};
