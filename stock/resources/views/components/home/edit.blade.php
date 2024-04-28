@extends('layouts.app')
@section('title','Edit stok')
@section('content')


<div class="container">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form input</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('update.stok',$stokBarang->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3 row">
                    <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" name="gambar" id="gambar" value="{{ $stokBarang->gambar }}" class="form-control @error('gambar') is-invalid @enderror">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img class="my-3" src="{{ asset('gambar/' . $stokBarang->gambar) }}" alt="{{ $stokBarang->nama_gambar }}" width="50">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_barang" id="kode_barang" value="{{ $stokBarang->kode_barang }}" class="form-control @error('kode_barang') is-invalid @enderror">
                        @error('kode_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_barang" id="nama_barang" value="{{ $stokBarang->nama_barang }}" class="form-control @error('nama_barang') is-invalid @enderror">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                            <option value="">--Pilih Kategori--</option>
                            <option value="Kategori 1" selected>Kategori 1</option>
                            <option value="Kategori 2" selected>Kategori 2</option>
                            <option value="Kategori 3" selected>Kategori 3</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok Barang</label>
                    <div class="col-sm-10">
                        <input type="number" name="stok" id="stok" value="{{ $stokBarang->stok }}" class="form-control @error('stok') is-invalid @enderror">
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" name="harga" id="harga" value="{{ $stokBarang->harga  }}" class="form-control @error('harga') is-invalid @enderror">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm my-3" style="float: right">Simpan</button>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
@endsection
