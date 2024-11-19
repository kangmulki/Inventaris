@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #000">Edit Data</h4>

            <form action="{{ route('peminjaman.update', $pinjam->id) }}" method="POST" enctype="multipart/form-data"
                class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="" class="form-label">Nama Barang</label>
                    <select name="id_barang" class="form-control" id="" value="{{ $pinjam->pusat->nama }}" style="color: #000; background-color: #f5f5f5;">
                        @foreach ($pusat as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $pinjam->pusat->id ? 'selected' : '' }}>
                                {{ $data->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="" class="form-label">Merek</label>
                    <select name="id_barang" class="form-control" id="" value="{{ $pinjam->pusat->merek }}" style="color: #000; background-color: #f5f5f5;">
                        @foreach ($pusat as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $pinjam->pusat->id ? 'selected' : '' }}>
                                {{ $data->merek }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="exampleInputEmail3">Jumlah</label>
                    <input type="number" class="form-control" id="exampleInputEmail3" name="jumlah"
                        value="{{ $pinjam->jumlah }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Tanggal Pinjam</label>
                    <input type="date" class="form-control" id="exampleInputPassword4"
                        name="tgl_pinjam" value="{{ $pinjam->tgl_pinjam }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Tanggal Kembali</label>
                    <input type="date" class="form-control" id="exampleInputPassword4"
                        name="tgl_kembali" value="{{ $pinjam->tgl_kembali }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Nama Peminjam</label>
                    <input type="text" class="form-control" id="exampleInputPassword4"
                        name="nama_peminjam" value="{{ $pinjam->nama_peminjam }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Status</label>
                    <select name="status" class="form-control" id="" value="{{ $pinjam->status }}" style="color: #000; background-color: #f5f5f5;">
                        <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                        <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
