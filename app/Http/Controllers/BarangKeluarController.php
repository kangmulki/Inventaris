<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataPusat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

Carbon::setLocale('id');

class BarangKeluarController extends Controller
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
        $keluar = BarangKeluar::all();
        confirmDelete('delete', 'Apakah Anda Yakin?');

        foreach ($keluar as $data) {
            $data->formatted_tanggal = Carbon::parse($data->tgl_keluar)->translatedFormat('l, d F Y');
        }

        return view('barangkeluar.index', compact('keluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pusat = DataPusat::all();
        return view('barangkeluar.create', compact('pusat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keluar = new BarangKeluar();
        $keluar->jumlah = $request->jumlah;
        $keluar->tgl_keluar = $request->tgl_keluar;
        $keluar->ket = $request->ket;
        $keluar->id_barang = $request->id_barang;

        $pusat = DataPusat::findOrFail($request->id_barang);
        if ($pusat->stok < $request->jumlah) {
            Alert::warning('Warning', 'Stok Tidak Cukup')->autoClose(1500);
            return redirect()->route('barangkeluar.index');
        } else {
            $pusat->stok -= $request->jumlah;
            $pusat->save();
        }

        $keluar->save();
        Alert::success('success', 'Data Berhasil Ditambahkan')->autoClose(1500);
        return redirect()->route('barangkeluar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.show', compact('keluar'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        $pusat = DataPusat::all();
        return view('barangkeluar.edit', compact('keluar', 'pusat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        $pusat = DataPusat::findOrFail($keluar->id_barang);

        if ($pusat->stok < $request->jumlah) {
            Alert::warning('Warning', 'Stok Tidak Cukup')->autoClose(1500);
            return redirect()->route('barangkeluar.index');
        } else {
            $pusat->stok += $keluar->jumlah;
            $pusat->stok -= $request->jumlah;
            // $pusat->stok = $pusat->stok - $keluar->jumlah + $request->jumlah;
            $pusat->save();
        }

        $keluar->update($request->all());

        $keluar->save();
        Alert::success('success', 'Data Berhasil Diubah')->autoClose(1500);
        return redirect()->route('barangkeluar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        $pusat = DataPusat::findOrFail($keluar->id_barang);
        $pusat->stok += $keluar->jumlah;
        $pusat->save();
        $keluar->delete();
        Alert::success('success', 'Data Berhasil Dihapus')->autoClose(1500);
        return redirect()->route('barangkeluar.index');
    }
}
