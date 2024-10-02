@extends('layouts.app')

@section('content')
<br>
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('album.create') }}" class="btn btn-primary">Tambah Album</a> <!-- Tombol Tambah Album -->
        </div>

        <form action="{{ route('album.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="judul_album" class="form-label">Judul Album</label>
                <input type="text" name="judul_album" id="judul_album" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="isi_album" class="form-label">URL Gambar</label>
                <input type="url" name="isi_album" id="isi_album" class="form-control" required>
                <small class="form-text text-muted">Masukkan URL gambar yang valid.</small>
            </div>
            <div class="mb-3">
                <label for="status_album" class="form-label">Status</label>
                <select name="status_album" id="status_album" class="form-select" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
              <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->judul }}</option>
                @endforeach
            </select>
        </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('album.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
