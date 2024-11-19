<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DataPusat;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

Carbon::setLocale('id');

class BarangMasukController extends Controller
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

    public function index(Request $request)
    {
        
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if ($tanggalAwal && $tanggalAkhir) {
            // Memfilter data berdasarkan tanggal
            $masuk = BarangMasuk::whereBetween('tgl_masuk', [$tanggalAwal, $tanggalAkhir])->get();
        } else {
            // Jika tidak ada input tanggal, menampilkan semua data
            $masuk = BarangMasuk::all();
        }
        
        // if (!$tanggalAwal || !$tanggalAkhir) {
        //     $masuk = BarangMasuk::all()->map(function ($masuk) {
        //         $masuk->umur = Carbon::parse($masuk->tgl_masuk)->translatedFormat('l, d F Y');
        //         return $masuk;
        //     });
        // } else {
        //     $masuk = BarangMasuk::whereBetween('tgl_masuk', [$tanggalAwal, $tanggalAkhir])->get();
        // }

        // format tanggal
        foreach ($masuk as $data) {
            $data->formatted_tanggal = Carbon::parse($data->tgl_masuk)->translatedFormat('l, d F Y');
        }

        // download pdf
        if ($request->has('download_pdf')) {
            // menampilkan data sekarang di pdf
            $pdf = PDF::loadView('laporan.pdf_barangMasuk', compact('masuk'));
            return $pdf->download('laporan_barang_masuk.pdf'); //ini buat download pdf
        }

        confirmDelete('delete', 'Apakah Anda Yakin?');
        return view('barangmasuk.index', compact('masuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pusat = DataPusat::all();
        return view('barangmasuk.create', compact('pusat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $masuk = new BarangMasuk();
        $masuk->jumlah = $request->jumlah;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->ket = $request->ket;
        $masuk->id_barang = $request->id_barang;

        $pusat = DataPusat::findOrFail($request->id_barang);
        $pusat->stok += $request->jumlah;
        $pusat->save();

        $masuk->save();
        Alert::success('Success', 'Data Berhasil Ditambahkan')->autoClose(1500);
        return redirect()->route('barangmasuk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        $pusat = DataPusat::all();
        return view('barangmasuk.edit', compact('masuk', 'pusat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        $pusat = DataPusat::findOrFail($masuk->id_barang);
        $pusat->stok -= $masuk->jumlah;
        $pusat->stok += $request->jumlah;
        $pusat->save();
        $masuk->jumlah = $request->jumlah;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->ket = $request->ket;
        $masuk->id_barang = $request->id_barang;

        $masuk->save();
        Alert::success('Success', 'Data Berhasil diedit')->autoClose(1500);
        return redirect()->route('barangmasuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        $pusat = DataPusat::findOrFail($masuk->id_barang);
        $pusat->stok -= $masuk->jumlah;
        $pusat->save();
        $masuk->delete();
        Alert::success('Success', 'Data Berhasil Dihapus')->autoClose(1500);
        return redirect()->route('barangmasuk.index');
    }
}
