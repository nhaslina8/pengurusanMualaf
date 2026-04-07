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
        Schema::create('mastercodes', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Category', 50);
            $table->string('Code', 50);
            $table->string('Description', 255)->nullable();
            $table->integer('OrderNo')->nullable();
            $table->string('Status', 1)->nullable();
            $table->string('Value1', 100)->nullable();
            $table->string('Value2', 100)->nullable();
            $table->string('Value3', 100)->nullable();
            $table->string('Value4', 100)->nullable();
            $table->string('Value5', 100)->nullable();
            $table->dateTime('CreatedDate')->nullable();
            $table->dateTime('UpdatedDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mastercodes');
    }
};
