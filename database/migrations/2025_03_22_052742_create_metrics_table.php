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
        Schema::create('metrics', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('branch_id')->nullable(); // Foreign key for branch
            $table->integer('calls')->nullable(); // Nullable integer field for calls
            $table->integer('customer_visited')->nullable(); // Nullable integer field for customer_visited
            $table->integer('approved')->nullable(); // Nullable integer field for approved
            $table->integer('selected')->nullable(); // Nullable integer field for selected
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraint
            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('set null'); // Set branch_id to null if the branch is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metrics', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['branch_id']);
        });

        Schema::dropIfExists('metrics');
    }
};
