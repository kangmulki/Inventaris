@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-center">
                        <img src="{{ asset('admin/assets/images/logo smk.png') }}" alt="" width="19%">
                        {{-- <h1 class="card-title mb-1" style="color: #000">Selamat Datang, {{ Auth::user()->name }}</h1> --}}
                    </div>
                    <center>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="col-12">
                                <h2 class="card-title" style="color: #000">Sistem Inventaris Barang</h2>
                                <h4 class="card-title mt-2" style="color: #000">SMK ASSALAAM BANDUNG</h4>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Data di Data Barang</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $data }} Data</h2>
                            </div>
                            <a href="{{ route('datapusat.index') }}" class="btn btn-primary btn-sm mt-2">Lihat</a>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <div class="icon icon-box-primary">
                                <span class="mdi mdi-bank icon-item"></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Data di Data Barang Masuk</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $masuk }} Data</h2>
                            </div>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-primary btn-sm mt-2">Lihat</a>

                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Data di Data Barang Keluar</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $keluar }} Data</h2>

                            </div>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-primary btn-sm mt-2">Lihat</a>

                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <div class="icon icon-box-danger">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Data di Data Pengembalian</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $dikembalikan }} Data</h2>

                            </div>
                            <a href="{{ route('pengembalian.index') }}" class="btn btn-primary btn-sm mt-2">Lihat</a>

                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Jumlah Data di Data Peminjaman</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $pinjam }} Data</h2>

                            </div>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-sm mt-2">Lihat</a>

                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <div class="icon icon-box-danger">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
