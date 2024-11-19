<?php

namespace App\Http\Controllers;

use App\Models\DataPusat;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

Carbon::setlocale('id');

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pinjam = Peminjaman::all();
        confirmDelete('delete', 'Apakah Anda Yakin?');

        foreach ($pinjam as $data) {
            $data->formatted_tanggal_pinjam = Carbon::parse($data->tgl_pinjam)->translatedFormat('l, d F Y');
        }

        foreach ($pinjam as $data) {
            $data->formatted_tanggal_kembali = Carbon::parse($data->tgl_kembali)->translatedFormat('l, d F Y');
        }

        return view('peminjaman.index', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pusat = DataPusat::all();
        return view('peminjaman.create', compact('pusat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pinjam = new Peminjaman;
        $pinjam->jumlah = $request->jumlah;
        $pinjam->tgl_pinjam = $request->tgl_pinjam;
        $pinjam->tgl_kembali = $request->tgl_kembali;
        $pinjam->nama_peminjam = $request->nama_peminjam;
        $pinjam->id_barang = $request->id_barang;
        $pinjam->status = "Sedang Dipinjam";

        $pusat = DataPusat::findOrFail($request->id_barang);
        if ($pusat->stok < $request->jumlah) {
            Alert::warning('Warning', 'Stok Tidak Cukup')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            $pusat->stok -= $request->jumlah;
            $pusat->save();
        }

        $pinjam->save();
        Alert::success('Success', 'Data Berhasil Ditambahkan')->autoclose(1500);
        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        return view('peminjaman.show', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pusat = DataPusat::all();
        return view('peminjaman.edit', compact('pinjam', 'pusat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pusat = DataPusat::findOrFail($pinjam->id_barang);

        // status pengembalian
        if ($request->status == "Sudah Dikembalikan") {
            $pusat->stok += $pinjam->jumlah;
            $pusat->save();
        }

        //logic perubahan ketika update
        if ($pusat->stok < $request->jumlah) {
            Alert::warning('Warning', 'Stok Tidak Cukup')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            $pusat->stok += $pinjam->jumlah;
            $pusat->stok -= $request->jumlah;
            $pusat->save();
        }

        $pinjam->update($request->all());

        $pinjam->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoclose(1500);
        return redirect()->route('peminjaman.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->delete();
        Alert::success('Success', 'Data Berhasil Dihapus')->autoclose(1500);
        return redirect()->route('peminjaman.index');
    }
}
