<?php

namespace App\Http\Controllers;

use App\Models\DataPusat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;



class DataPusatController extends Controller
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
        $datapusat = DataPusat::all();

         // download pdf
         if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('laporan.pdf_dataPusat', compact('datapusat'));
            return $pdf->download('laporan_data_pusat.pdf'); //ini buat download pdf
        }

        confirmDelete('delete', 'Apakah Anda Yakin?');
        return view('datapusat.index', compact('datapusat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datapusat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datapusat = new DataPusat;
        $datapusat->nama = $request->nama;
        $datapusat->merek = $request->merek;

        $datapusat->save();
        Alert::success('Success', 'Data Berhasil Ditambahkan') ->autoClose(1500);
        return redirect()->route('datapusat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPusat  $dataPusat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datapusat = DataPusat::findOrFail($id);
        return view('datapusat.show', compact('datapusat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPusat  $dataPusat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datapusat = DataPusat::findOrFail($id);
        return view('datapusat.edit', compact('datapusat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPusat  $dataPusat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datapusat = DataPusat::findOrFail($id);
        $datapusat->nama = $request->nama;
        $datapusat->merek = $request->merek;
        $datapusat->save();
        Alert::success('Success', 'Data Berhasil Diubah') ->autoClose(1500);
        return redirect()->route('datapusat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPusat  $dataPusat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datapusat = DataPusat::findOrFail($id);
        $datapusat->delete();
        Alert::success('Success', 'Data Berhasil Dihapus')->autoClose(1500);
        return redirect()->route('datapusat.index');
    }
}
