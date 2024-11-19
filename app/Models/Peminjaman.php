<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali',
        'nama_peminjam',
        'status',
        'id_barang',
    ];

    public $timestamps = true;


    public function pusat() {
        return $this->belongsTo(DataPusat::class,'id_barang');
    }

    public function kembali() {
        return $this->hasMany(Pengembalian::class);
    }
}
