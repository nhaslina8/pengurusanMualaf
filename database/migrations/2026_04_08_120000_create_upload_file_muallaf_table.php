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
        if (Schema::hasTable('UPLOAD_FILE_MUALLAF')) {
            return;
        }

        Schema::create('UPLOAD_FILE_MUALLAF', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('REFNO', 100);
            $table->string('TYPE', 50)->nullable();
            $table->string('REFNO2', 100)->nullable();
            $table->string('TYPE2', 50)->nullable();
            $table->string('REFNO3', 100)->nullable();
            $table->string('ORDERNO', 50);
            $table->string('FILE_NAME', 500);
            $table->string('FILE_LOC', 500);
            $table->binary('FILE_DATA')->nullable();
            $table->string('SYNCB', 100);
            $table->dateTime('SYNCD')->useCurrent();
            $table->string('SYNCA', 100)->nullable();
            $table->string('SYNMB', 100)->nullable();
            $table->dateTime('SYNMD')->nullable()->useCurrent();
            $table->string('SYNMA', 100)->nullable();
            $table->string('REFNO4', 100)->nullable();
            $table->string('REFNO5', 100)->nullable();
            $table->bigInteger('FILE_SIZE')->nullable();
            $table->string('CONTENT_TYPE', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UPLOAD_FILE_MUALLAF');
    }
};
