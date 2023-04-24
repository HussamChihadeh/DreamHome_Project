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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
            $table->string("name");
            $table->integer("price");
            $table->string("description");
            $table->string("province");
            $table->string("city");
            $table->string("street");
            $table->decimal("latitude", 8, 5);
            $table->decimal("longitude", 8, 5);
            $table->string("type");
            $table->integer("parking");
            $table->integer("bedrooms");
            $table->integer("bathrooms");
            $table->string("area");
            $table->integer("built_in");
            $table->string("buy_or_rent");
            $table->string("status")->default("pending"); //pending(requested), listed, sold
            $table->dateTime("requested_date")->nullable();
            $table->dateTime("sold_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
