<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');

            $table->unsignedInteger('business_id')->nullable();
            $table->foreign('business_id')->references('business_id')->on('businesses')->onDelete('cascade');

            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('status', ['pending', 'in_progress', 'completed'])
                ->default('pending');

            $table->date('due_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
