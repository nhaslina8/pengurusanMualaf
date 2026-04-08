<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maklumat_pendakwahs', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('IdAkaunPengguna')->default(0);
            $table->string('NamaIslam', 150);
            $table->string('NoKP', 20)->nullable();
            $table->string('Daerah', 100)->nullable();
            $table->string('Jantina', 10)->nullable();
            $table->string('Bangsa', 50)->nullable();
            $table->string('Kategori', 50)->nullable();
            $table->string('NoTel1', 20)->nullable();
            $table->string('NamaAsal', 150)->nullable();
            $table->date('TarikhIslam')->nullable();
            $table->string('Alamat1', 200)->nullable();
            $table->string('Alamat2', 200)->nullable();
            $table->string('Alamat3', 200)->nullable();
            $table->string('Poskod', 10)->nullable();
            $table->string('Bandar', 100)->nullable();
            $table->string('Negeri', 100)->nullable();
            $table->string('KodBank', 20)->nullable();
            $table->string('NoAkaunBank', 50)->nullable();
            $table->text('Catatan')->nullable();
            $table->string('Status', 1)->nullable();
            $table->string('SynCB', 50)->nullable();
            $table->dateTime('SynCD')->nullable();
            $table->string('SynCA', 50)->nullable();
            $table->string('SynMB', 50)->nullable();
            $table->dateTime('SynMD')->nullable();
            $table->string('SynMA', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maklumat_pendakwahs');
    }
};
