@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Album</h1>
        <br>

        <!-- Form Edit Album -->
        <form action="{{ route('album.update', $album->kd_album) }}" method="POST"> <!-- Pastikan menggunakan kd_album sebagai identifier -->
            @csrf
            @method('PUT')

            <!-- Input Judul Album -->
            <div class="mb-3">
                <label for="judul_album" class="form-label">Judul Album</label>
                <input type="text" name="judul_album" id="judul_album" class="form-control" value="{{ $album->judul_album }}" required>
            </div>

            <!-- Input URL Gambar -->
            <div class="mb-3">
                <label for="isi_album" class="form-label">URL Gambar</label>
                <input type="url" name="isi_album" id="isi_album" class="form-control" value="{{ $album->isi_album }}" required>
                <small class="form-text text-muted">Masukkan URL gambar yang valid.</small>
            </div>

            <!-- Select Status Album -->
            <div class="mb-3">
                <label for="status_album" class="form-label">Status</label>
                <select name="status_album" id="status_album" class="form-select" required>
                    <option value="1" {{ $album->status_album ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$album->status_album ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <!-- Select Kategori -->
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select class="form-select" id="kategori_id" name="kategori_id" required>
                    <option value="" disabled>Pilih Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ $kat->id == $album->kategori_id ? 'selected' : '' }}>{{ $kat->judul }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Update -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('album.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
