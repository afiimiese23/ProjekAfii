<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table        =   'warga';
    protected $primaryKey   =   'warga_id';
    protected $fillable     =   [
        'no_ktp',
        'nama',
        'gender',
        'agama',
        'pekerjaan',
        'phone',
        'email',
    ];
}
