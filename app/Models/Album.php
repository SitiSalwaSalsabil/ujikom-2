<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album'; // Pastikan ini adalah nama tabel Anda
    protected $primaryKey = 'kd_album'; // Primary key

    // Daftar kolom yang dapat diisi
    protected $fillable = [
        'judul_album',
        'isi_album',
        'user_id',
        'status_album', // Tambahkan ini
        'created_at',
        'updated_at',
        'kategori_id',
    ];
    
    public $timestamps = true;
    
    // Jika menggunakan kolom created_at dan updated_at
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}    
    
