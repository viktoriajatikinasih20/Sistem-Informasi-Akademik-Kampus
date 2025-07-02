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
        Schema::create('nilai_dan_transkrip', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('matakuliah_id');
        
            $table->float('nilai_angka'); // atau double

            $table->string('nilai_huruf')->nullable(); // (opsional) hasil konversi A-E
            $table->decimal('bobot', 3, 2)->nullable(); // (opsional) bobot 4.00, 3.00, dll
            $table->integer('sks');
            $table->decimal('sksn', 5, 2); // bisa decimal, karena bisa 3.00 * 4 = 12.00
        
            $table->timestamps();
        
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('matakuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_dan_transkrip');
    }
};
