<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DataPusat;
use App\Models\Peminjaman;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DataPusat::count('id');
        $masuk = BarangMasuk::count('id');
        $keluar = BarangKeluar::count('id');
        $pinjam = Peminjaman::count('id');
        $dikembalikan = Peminjaman::where('status', 'Sudah Dikembalikan')->count('id');
        return view('home', compact('data', 'masuk', 'keluar', 'pinjam', 'dikembalikan'));
    }
}
