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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');

            $table->string('name');
            $table->string('image')->nullable();   // profile photo / document image
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->text('address')->nullable();
            $table->string('pincode', 10)->nullable();

            $table->timestamps();
            $table->softDeletes(); // creates deleted_at automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
