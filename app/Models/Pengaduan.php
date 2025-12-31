<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Multipleupload;
use App\Models\KategoriPengaduan;
use App\Models\Warga;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nomor_tiket',
        'warga_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'lokasi_text',
        'rt',
        'rw'
    ];

    // Relasi ke Kategori Pengaduan
    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Tindak Lanjut
    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'id', 'id');
    }

    // Relasi ke Penilaian Layanan
    public function penilaian()
    {
        return $this->hasOne(PenilaianLayanan::class, 'id', 'id');
    }

    // Relasi ke Media
    public function media()
    {
        return $this->morphMany(Media::class, 'ref'); // jika pakai polymorphic
    }

        public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }

    public function files()
    {
        return $this->hasMany(Multipleupload::class, 'ref_id', 'id')
                    ->where('ref_table', 'pengaduan');
    }
}
