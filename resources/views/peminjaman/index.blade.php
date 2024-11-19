@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection
@section('content')
<center>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2>Halaman Data Peminjaman</h2>
                </div>
            </div>
        </div>
    </div>
    </center>
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h4 class="card-title" style="color: #000">Data Barang</h4>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-md btn-info" style="float: right">Tambah Data</a>
            <div class="table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Nama Peminjam</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pinjam as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->pusat->nama }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->formatted_tanggal_pinjam }}</td>
                                <td>{{ $data->formatted_tanggal_kembali }}</td>
                                <td>{{ $data->nama_peminjam }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <form action="{{ route('peminjaman.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('peminjaman.edit', $data->id) }}"
                                            class="btn btn-success">Edit</a>
                                        {{-- <a href="{{ route('peminjaman.show', $data->id) }}"
                                            class="btn btn-warning">Show</a> --}}
                                        <a href="{{ route('peminjaman.destroy', $data->id) }}" type="submit" class="btn btn-danger" data-confirm-delete="true">
                                            Delete
                                        </a>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> --}}
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script> --}}
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['pdf', 'excel']
                }
            }
        });
    </script>
@endpush
