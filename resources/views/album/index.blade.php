@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">Halaman Album</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album.index') }}">Daftar Album</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album.create') }}">Tambah Album</a>
                </li>
                <!-- Tambahkan item menu lain di sini jika perlu -->
            </ul>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="mb-4">Daftar Album</h1>
        
        <!-- Tombol Tambah Album -->
        <div class="mb-3">
            <a href="{{ route('album.create') }}" class="btn btn-primary">Tambah Album</a>
        </div>

        <!-- Tabel Daftar Album -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Album</th>
                            <th>Judul Album</th>
                            <th>URL Gambar</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $item)  <!-- Menggunakan variabel $albums untuk daftar album -->
                            <tr>
                                <td>{{ $item->kd_album }}</td>
                                <td>{{ $item->judul_album }}</td>
                                <td>
                                    <img src="{{ $item->isi_album }}" alt="{{ $item->judul_album }}" style="width: 250px; height: auto;"> <!-- Menampilkan gambar album -->
                                </td>
                                <td class="{{ $item->status_album ? 'text-success' : 'text-danger' }}">
                                    {{ $item->status_album ? 'Aktif' : 'Tidak Aktif' }}
                                </td>
                                <td>{{ $item->kategori ? $item->kategori->judul : 'Tidak ada Kategori' }}</td> <!-- Menampilkan kategori album -->
                                <td>
                                    <!-- Tombol Edit Album -->
                                    <a href="{{ route('album.edit', $item->kd_album) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Form Hapus Album -->
                                    <form action="{{ route('album.destroy', $item->kd_album) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="mb-3 mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a> <!-- Route menuju dashboard -->
        </div>
    </div>
@endsection
