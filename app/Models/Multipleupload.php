<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multipleupload extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';

    protected $fillable = [
        'filename',
        'ref_table',
        'ref_id',
    ];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->filename);
    }

    public function scopeForWarga($query, $id)
    {
        return $query->where('ref_table', 'warga')
                     ->where('ref_id', $id);
    }
}
