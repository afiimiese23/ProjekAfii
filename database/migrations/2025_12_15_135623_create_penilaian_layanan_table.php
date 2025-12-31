<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penilaian_layanan', function (Blueprint $table) {
            $table->id('penilaian_id'); // PK

            $table->unsignedBigInteger('pengaduan_id'); // FK ke pengaduan

            $table->tinyInteger('rating'); // misal 1–5
            $table->text('komentar')->nullable();

            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('pengaduan_id')
                  ->references('id')
                  ->on('pengaduan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_layanan');
    }
};
