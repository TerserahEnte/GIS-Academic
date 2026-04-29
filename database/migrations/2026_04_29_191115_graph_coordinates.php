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
        Schema::create('nodes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->integer('floor');
            $table->integer('lat');
            $table->integer('lng');
        });

        Schema::create('edges', function (Blueprint $table) {
            $table->id();
            $table->integer('from_node_id');
            $table->integer('to_node_id');
            $table->integer('weight');
            $table->boolean('is_stairs')->default(false);

            $table->foreign('from_node_id')->references('id')->on('nodes')->onDelete('cascade');
            $table->foreign('to_node_id')->references('id')->on('nodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edges');
        Schema::dropIfExists('nodes');
    }
};
