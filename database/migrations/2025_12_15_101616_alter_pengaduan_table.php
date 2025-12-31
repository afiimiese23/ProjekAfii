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
        Schema::table('pengaduan', function (Blueprint $table) {

            // kalau kolom belum ada
            if (!Schema::hasColumn('pengaduan', 'nomor_tiket')) {
                $table->string('nomor_tiket')->unique()->after('id');
            }

            if (!Schema::hasColumn('pengaduan', 'warga_id')) {
                $table->unsignedInteger('warga_id')->after('nomor_tiket');
            }

            if (!Schema::hasColumn('pengaduan', 'kategori_id')) {
                $table->unsignedInteger('kategori_id')->after('warga_id');
            }

            if (!Schema::hasColumn('pengaduan', 'judul')) {
                $table->string('judul', 150)->after('kategori_id');
            }

            if (!Schema::hasColumn('pengaduan', 'deskripsi')) {
                $table->text('deskripsi')->after('judul');
            }

            if (!Schema::hasColumn('pengaduan', 'status')) {
                $table->enum('status', ['baru', 'diproses', 'selesai'])
                    ->default('baru')
                    ->after('deskripsi');
            }

            if (!Schema::hasColumn('pengaduan', 'lokasi_text')) {
                $table->string('lokasi_text')->nullable();
            }

            if (!Schema::hasColumn('pengaduan', 'rt')) {
                $table->string('rt', 5)->nullable();
            }

            if (!Schema::hasColumn('pengaduan', 'rw')) {
                $table->string('rw', 5)->nullable();
            }

            // foreign key
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori_pengaduan')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropForeign(['warga_id']);
            $table->dropForeign(['kategori_id']);

            $table->dropColumn([
                'nomor_tiket',
                'warga_id',
                'kategori_id',
                'judul',
                'deskripsi',
                'status',
                'lokasi_text',
                'rt',
                'rw'
            ]);
        });
    }
};
