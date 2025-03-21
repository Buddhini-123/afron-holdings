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
        Schema::create('masterlist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->string('jw_no')->nullable();
            $table->string('position1')->nullable();
            $table->string('position2')->nullable();
            $table->string('position3')->nullable();
            $table->unsignedBigInteger('interviewer_id')->nullable();
            $table->unsignedBigInteger('re_id')->nullable();
            $table->boolean('cv')->nullable();
            $table->boolean('jeevan_application')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterlist');
    }
};
