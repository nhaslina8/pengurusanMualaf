<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lantikan_pendakwahs', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('IdPendakwah');
            $table->integer('Tahun')->nullable();
            $table->date('TarikhMula')->nullable();
            $table->date('TarikhAkhir')->nullable();
            $table->text('Catatan')->nullable();
            $table->string('Status', 1)->nullable();
            $table->string('SynCB', 50)->nullable();
            $table->dateTime('SynCD')->nullable();
            $table->string('SynCA', 50)->nullable();
            $table->string('SynMB', 50)->nullable();
            $table->dateTime('SynMD')->nullable();
            $table->string('SynMA', 50)->nullable();

            $table->index('IdPendakwah');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lantikan_pendakwahs');
    }
};
