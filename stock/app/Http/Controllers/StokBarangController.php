<?php

namespace App\Http\Controllers;

use App\Models\stokBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokBarang=stokBarang::all();
        return view('components.home.index', compact('stokBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_barang' => 'required|max:255',
            'kode_barang'=>'required|unique:stok_barangs',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // tambahkan validasi untuk file gambar
            'stok' => 'required|numeric',
            'harga'=>'required',
            'kategori'=>'required'
            // tambahkan validasi lainnya sesuai kebutuhan
        ],[
            'nama_barang.required'=>'Nama barang harus diisi.',
            'nama_barang.max'=>'Nama barang maksimal 255 karakter',
            'kode_barang.required'=>'Kode barang harus diisi.',
            'kode_barang.unique'=>'Kode barang tidak boleh sama.',
            'gambar.required' => 'Gambar barang wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, dan gif.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
            'stok.required'=>'Stok harus diisi',
            'stok.required'=>'Stok harus berupa angka',
        ]);

        // Proses gambar yang diunggah
        $gambar = $request->file('gambar');
        $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
        $lokasi_gambar = public_path('/gambar'); // tentukan lokasi penyimpanan gambar
        $gambar->move($lokasi_gambar, $nama_gambar);

        // Simpan data stok barang ke basis data
        stokBarang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang'=>$request->kode_barang,
            'gambar' => $nama_gambar, // simpan nama file gambar dalam basis data
            'kategori'=>$request->kategori,
            'stok' => $request->stok,
            'harga'=>$request->harga,
        ]);

        return redirect('home')->with('success', 'Stok barang berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokBarang=stokBarang::find($id);
        return view('components.home.edit', compact('stokBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'kode_barang'=>'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // tambahkan validasi untuk file gambar
            'stok' => 'required|numeric',
            'harga'=>'required',
            'kategori'=>'required'
            // tambahkan validasi lainnya sesuai kebutuhan
        ],[
            'nama_barang.required'=>'Nama barang harus diisi.',
            'nama_barang.max'=>'Nama barang maksimal 255 karakter',
            'kode_barang.required'=>'Kode barang harus diisi.',
            'kode_barang.unique'=>'Kode barang tidak boleh sama.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, dan gif.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
            'stok.required'=>'Stok harus diisi',
            'stok.numeric'=>'Stok harus berupa angka',
            'kategori.required'=>'Kategori harus dipilih',
            'kategori.harga'=>'Harga harus diisi',
        ]);

        // Temukan stok barang yang akan diperbarui
        $stokBarang = stokBarang::find($id);

        // Jika ada gambar yang diunggah, proses gambar baru
        if ($request->hasFile('gambar')) {
            // Proses gambar yang diunggah
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $lokasi_gambar = public_path('/gambar'); // tentukan lokasi penyimpanan gambar
            $gambar->move($lokasi_gambar, $nama_gambar);

            // Hapus gambar lama jika ada
            if ($stokBarang->gambar) {
                unlink(public_path('/gambar/' . $stokBarang->gambar));
            }

            // Simpan nama file gambar baru dalam basis data
            $stokBarang->gambar = $nama_gambar;
        }

        // Update data stok barang ke basis data
        $stokBarang->kode_barang = $request->kode_barang;
        $stokBarang->nama_barang = $request->nama_barang;
        $stokBarang->stok = $request->stok;
        $stokBarang->harga = $request->harga;
        $stokBarang->kategori = $request->kategori;
        $stokBarang->save();

        return redirect('home')->with('info', 'Stok barang berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function delete($id)
    {
        $stokBarang=stokBarang::find($id);
        $stokBarang->delete();
        return back()->with('done', 'Stok barang berhasil dihapus.');
    }
}
