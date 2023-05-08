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
        Schema::create('designers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // foreign key
            $table->string("name");
            $table->string("email");
            $table->string("age");
            $table->string("address");
            $table->string("experience");
            $table->string("phone_number");
            $table->string("bio");
            $table->string("linkedin");
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designers');
    }
};
