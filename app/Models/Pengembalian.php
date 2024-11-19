<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
       'id',
       'jumlah',
       'tgl_kembali',
       'nama_peminjam',
       'status',
       'id_peminjam',
       'id_barang', 
    ];

    public $timestamps = true;


    public function pusat() {
        return $this->belongsTo(DataPusat::class,'id_barang');
    }

    public function peminjam() {
        return $this->belongsTo(Peminjam::class,'id_peminjam');
    }
}
