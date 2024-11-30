<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';

    protected $fillable = [
        'user_id',
        'nama_company',
        'nama_pemilik',
        'alamat',
        'image_users',
        'rekening',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
