<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLayanan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_layanan';
    protected $primaryKey = 'penilaian_id';
    protected $fillable = [
        'pengaduan_id',
        'rating',
        'komentar',
    ];

    /**
     * Scope untuk search (dipakai di index)
     */
    public function scopeSearch($query, $request, $columns)
    {
        if ($request->search) {
            $keyword = '%' . $request->search . '%';

            $query->where(function ($q) use ($columns, $keyword) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', $keyword);
                }
            });
        }

        return $query;
    }

    /**
     * Relasi ke Pengaduan
     * pengaduan_id → pengaduan.id
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }
}
