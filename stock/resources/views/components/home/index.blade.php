@extends('layouts.app')
@section('title','Home')
@section('content')


<div class="container">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Home</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data stok barang</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p><i class="bi bi-x-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('info'))
            <div class="alert alert-info">
                <p><i class="bi bi-x-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('done'))
            <div class="alert alert-success">
                <p><i class="bi bi-x-circle-fill"></i><strong> Berhasil! </strong>{{ $message }}</p>
            </div>
            @endif
            <a href="{{ route('create.stok') }}" class="btn btn-primary btn-sm mb-2" style="float: right">Tambah data</a>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Kode Stok</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($stokBarang as $item)

                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><img src="{{ asset('gambar/' . $item->gambar) }}" alt="{{ $item->nama_gambar }}" width="100"></td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            <a href="{{ route('edit.stok', $item->id) }}" class="btn btn-primary btn-sm"> Edit</a>
                            <a href="{{ route('delete.stok', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Hapus</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
