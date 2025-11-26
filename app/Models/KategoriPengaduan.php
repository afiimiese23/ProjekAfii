<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    protected $table = 'kategori_pengaduan';
    protected $primaryKey = 'kategori_id';
    protected $fillable = ['nama', 'sla_hari', 'prioritas'];
    public $timestamps = false;

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
}
