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
        Schema::create('akaun_pengguna_mains', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Uid', 50);
            $table->string('Pass', 255)->nullable();
            $table->string('Category', 50)->nullable();
            $table->string('Status', 1)->nullable();
            $table->dateTime('LastLogin')->nullable();
            $table->string('TAC', 10)->nullable();
            $table->dateTime('TACExpired')->nullable();
            $table->string('SynCB', 50)->nullable();
            $table->dateTime('SynCD')->nullable();
            $table->string('SynCA', 50)->nullable();
            $table->string('SynMB', 50)->nullable();
            $table->dateTime('SynMD')->nullable();
            $table->string('SynMA', 50)->nullable();
            $table->string('VerifyEmailToken', 255)->nullable();
            $table->string('ForgotPasswordToken', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akaun_pengguna_mains');
    }
};
