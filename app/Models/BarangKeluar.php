<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'jumlah',
        'tgl_keluar',
        'ket',
        'id_barang',
    ];

    public $timestamps = true;


    public function pusat() {
        return $this->belongsTo(DataPusat::class,'id_barang');
    }
}
