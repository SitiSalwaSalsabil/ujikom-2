<?php

namespace App\Http\Controllers;

use App\Models\Album; // Pastikan model Album ada
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk menggunakan Auth

class AlbumController extends Controller
{
    // Menampilkan semua album
    public function index()
    {
        $albums = Album::all(); // Ambil semua data dari model Album
        return view('album.index', compact('albums')); // Menggunakan 'albums' untuk mengirim data
    }

    // Menampilkan form untuk menambah album
    public function create()
    {
        $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown
        return view('album.create', compact('kategori')); // Mengarahkan ke view untuk membuat album baru
    }

    // Menyimpan album baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'isi_album' => 'required|url', // Pastikan ini adalah URL yang valid
            'status_album' => 'required|boolean', // Validasi untuk status_album
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori yang ada
        ]);

        // Simpan data album ke database
        Album::create([
            'judul_album' => $request->judul_album,
            'isi_album' => $request->isi_album,
            'status_album' => $request->status_album,
            'user_id' => auth()->id(), // Simpan ID pengguna yang sedang login
            'kategori_id' => $request->kategori_id, // Mengambil dari request
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil ditambahkan.'); // Redirect dengan pesan sukses
    }

    // Menampilkan detail album
    public function show(Album $album)
    {
        return view('album.show', compact('album')); // Mengarahkan ke view untuk menampilkan detail album
    }

    // Menampilkan form untuk mengedit album
    public function edit($kd_album)
    {
        $album = Album::findOrFail($kd_album); // Pastikan album ditemukan dengan kode
        $kategori = Kategori::all(); // Ambil semua kategori
        return view('album.edit', compact('album', 'kategori')); // Kirim data album dan kategori
    }

    // Memperbarui album di database
    public function update(Request $request, $kd_album)
    {
        $album = Album::findOrFail($kd_album); // Temukan album berdasarkan kd_album

        // Validasi input
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'isi_album' => 'required|url', // Validasi untuk memastikan ini adalah URL yang valid
            'status_album' => 'required|boolean', // Validasi untuk status_album
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori
        ]);

        // Update data album
        $album->update([
            'judul_album' => $request->judul_album,
            'isi_album' => $request->isi_album, // Simpan URL gambar
            'status_album' => $request->status_album,
            'user_id' => Auth::id(), // Simpan ID pengguna yang sedang login
            'kategori_id' => $request->kategori_id, // Update kategori ID
            'updated_at' => now(), // Menyimpan waktu update saat ini
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil diperbarui.'); // Redirect dengan pesan sukses
    }

    // Menghapus album dari database
    public function destroy($kd_album)
    {
        $album = Album::findOrFail($kd_album); // Temukan album berdasarkan kd_album
        $album->delete(); // Menghapus album dari database

        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus.'); // Redirect dengan pesan sukses
    }
}

