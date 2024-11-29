<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $table = 'coordinates';
    protected $fillable = [
        'unique_id',
        'uuid',
        'panjang_perbaikan',
        'lebar_perbaikan',
        'nama_lokasi',
        'nama_company',
        'longlat',
        'foto',
        'tgl_start',
        'tgl_end',
        'status'
    ];
    protected $casts = [
        'longlat' => 'array'
    ];
    protected $dates = [
        'tgl_start',
        'tgl_end'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'unique_id', 'id');
    }
}
