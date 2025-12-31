<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->id('tindak_id'); // primary key
            $table->unsignedBigInteger('pengaduan_id'); // foreign key ke pengaduan
            $table->string('petugas');
            $table->string('aksi');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // foreign key constraint
            $table->foreign('pengaduan_id')
                  ->references('id')
                  ->on('pengaduan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
