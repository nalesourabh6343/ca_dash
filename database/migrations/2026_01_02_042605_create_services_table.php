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
        Schema::create('services', function (Blueprint $table) {
            $table->increments("service_id");
            $table->string('name');
            $table->decimal('fee')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable(); // Add deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
