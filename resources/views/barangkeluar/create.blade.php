@extends('layouts.admin')
@section('content')
<div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="color: #000">Tambah Data</h4>

                    <form action="{{route('barangkeluar.store')}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                      <div class="form-group">
                        <label for="" class="form-label">Nama Barang</label>
                        <select name="id_barang" class="form-control" id="" placeholder="Nama Barang" style="color: #000; background-color: #f5f5f5;">
                            <option value=""></option>
                            @foreach ($pusat as $data)
                                <option value="{{$data->id }}">
                                    {{$data->nama}}
                                </option>
                            @endforeach
                        </select>
                      </div>
                      {{-- <div class="form-group">
                        <label for="" class="form-label">Merek</label>
                        <select name="id_barang" class="form-control" id="" placeholder="Merek" style="color: #000; background-color: #f5f5f5;">
                            <option value=""></option>
                            @foreach ($pusat as $data)
                                <option value="{{$data->id }}">
                                    {{$data->merek}}
                                </option>
                            @endforeach
                        </select>
                      </div> --}}
                      <div class="form-group">
                        <label for="exampleInputEmail3">Jumlah</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Jumlah" name="jumlah" style="color: #000; background-color: #f5f5f5;">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Tanggal Keluar</label>
                        <input type="date" class="form-control" id="exampleInputPassword4" placeholder="Tanggal Keluar" name="tgl_keluar" style="color: #000; background-color: #f5f5f5;">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Keterangan</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Keterangan" name="ket" style="color: #000; background-color: #f5f5f5;">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <a href="{{route('barangkeluar.index')}}" class="btn btn-dark">Cancel</a>
                    </form>
                  </div>
                </div>
@endsection
