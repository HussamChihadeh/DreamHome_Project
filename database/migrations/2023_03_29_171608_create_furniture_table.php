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
        Schema::create('furniture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('designer_id');
            $table->foreign('designer_id')->references('id')->on('designers')->onDelete('cascade');;
            $table->string("name");
            $table->integer("price");
            $table->string("date");
            $table->string("style");
            $table->string("type");
            $table->string("material");
            $table->string("place");
            $table->string("quantity");
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture');
    }
};
