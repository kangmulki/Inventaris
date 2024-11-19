@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #000">Edit Data</h4>
            
            <form action="{{ route('datapusat.update', $datapusat->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputName1">Nama Barang</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Barang" value="{{ $datapusat->nama }}"
                        name="nama" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Merek</label>
                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Merek" name="merek" value="{{ $datapusat->merek }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Stok</label>
                    <input type="number" class="form-control" id="exampleInputPassword4" placeholder="Stok" name="stok" value="{{ $datapusat->stok }}" style="color: #000; background-color: #f5f5f5;">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                <a href="{{ route('datapusat.index') }}" class="btn btn-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
