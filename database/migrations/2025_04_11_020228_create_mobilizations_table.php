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
            $table->date('date');
            $table->string('number');
            $table->string('job_order_no');
            $table->string('company_name');
            $table->string('handled_by');
            $table->date('deadline');
            $table->string('country');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('mobilizations');
    }
};
