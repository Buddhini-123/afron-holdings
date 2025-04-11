<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mobilization_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobilization_id')->constrained()->onDelete('cascade');
            $table->string('position');
            $table->integer('req_no')->default(0);
            $table->integer('total_cv')->default(0);
            $table->integer('bal_req_cv')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mobilization_positions');
    }
};
