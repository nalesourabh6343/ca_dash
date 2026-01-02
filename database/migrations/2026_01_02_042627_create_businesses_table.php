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
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments("business_id");
            // $table->string('pk_client_id');
            // $table->string('pk_document_id')->nullable();
            $table->string('business_name');
            $table->string('client_name');
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('financial_year');
            $table->text('description');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable(); // Add deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
