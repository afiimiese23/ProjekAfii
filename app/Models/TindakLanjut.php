<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Pengaduan;
use App\Models\Multipleupload;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_id';
    protected $fillable = [
        'pengaduan_id',
        'petugas',
        'aksi',
        'catatan'
    ];

    /**
     * Relasi ke Pengaduan
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }

    /**
     * Relasi ke Multiple Upload / Media
     */
    public function files()
    {
        return $this->hasMany(Multipleupload::class, 'ref_id', 'tindak_id')
                    ->where('ref_table', 'tindak_lanjut');
    }

    /**
     * Scope Filter untuk kolom tertentu
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    /**
     * Scope Search untuk kolom tertentu
     */
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }
}
