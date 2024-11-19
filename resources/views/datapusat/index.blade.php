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
                        <h2>Halaman Data Barang Pusat</h2>
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
            <h4 class="card-title" style="color: #000">
                Data Barang
            </h4>

            <!-- {{-- INI BAGIAN UNTUK FILTER --}}
            <form action="#" method="GET">
                <div class="row">
                    <div class="col-4">
                        <input type="date" class="" name="tanggal_awal"
                            value="#" required>
                    </div>
                    <div class="col-4">
                        <input type="date" class="" name="tanggal_akhir"
                            value="#" required>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary " type="submit">Filter</button>
                    </div>
                    <div class="col-2">
                        <a href="#" class="btn btn-danger "
                            type="submit">Reset</a>
                    </div>
                </div>
            </form> -->


                    {{-- INI UNTUK BAGIAN BUTTON EXPORT --}}
                    <div class="row mt-3 mr-2">
                        {{-- @if (!$pegawai->isEmpty()) --}}

                        {{-- <button id="lihatPdfButton" class="btn btn-secondary " data-bs-toggle="modal"
                            data-bs-target="#pdfModal">Lihat PDF</button> --}}
                        &nbsp;&nbsp;
                        <a href="{{ route('datapusat.index', ['download_pdf']) }}" class="btn btn-danger ">Buat PDF</a>
                        &nbsp;&nbsp;
                        <a href="" class="btn btn-success " type="submit">Buat EXCEL</a>

                        {{-- @endif --}}
                    </div>
                    <a href="{{ route('datapusat.create') }}" class="btn btn-info mt-3" style="float: right;">Tambah Data</a>

            {{-- <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Barang" name="nama" id="putih" style="color: #000; background-color: #f5f5f5;"> --}}
            Cari : <input type="text" placeholder="cari barang" class="mt-3 mb-2" id="myInput" style="color: #000; background-color: #f5f5f5;  border-color: #000; ">
            <div class="table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datapusat as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->merek }}</td>
                                <td>{{ $data->stok }}</td>
                                <td>
                                    <form action="{{ route('datapusat.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('datapusat.edit', $data->id) }}" class="btn btn-success">Edit</a>
                                        {{-- <a href="{{ route('datapusat.show', $data->id) }}" class="btn btn-warning">Show</a> --}}
                                        <a href="{{ route('datapusat.destroy', $data->id) }}" type="submit" class="btn btn-danger" data-confirm-delete="true">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: [0],
                }
            }
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endpush
