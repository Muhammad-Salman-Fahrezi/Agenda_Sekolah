@extends('layouts.app')

@section('content')

<style>
    /* Warna gradasi kalem */
    .custom-header {
        background: linear-gradient(135deg, #e3eaf1, #f8f9fa); /* Biru muda soft ke putih */
        color: #333;
        font-weight: bold;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Card dengan bayangan lembut */
    .custom-card {
        background: linear-gradient(135deg, #ffffff, #f5f5f5); /* Putih ke abu muda */
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    /* Button lebih soft */
    .btn-custom-save {
        background: linear-gradient(135deg, #6a9c78, #a5c9a4); /* Hijau olive lembut */
        color: white;
        border: none;
    }
    .btn-custom-save:hover {
        background: linear-gradient(135deg, #5a8c68, #94b894);
    }

    .btn-custom-back {
        background: linear-gradient(135deg, #8c8c8c, #bfbfbf); /* Abu-abu soft */
        color: white;
        border: none;
    }
    .btn-custom-back:hover {
        background: linear-gradient(135deg, #7a7a7a, #a5a5a5);
    }
</style>

<div class="container mt-5">
    <div class="custom-header">
        <h1 class="mb-0">Tambah Agenda Sekolah</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card custom-card">
        <form method="POST" action="{{ route('agenda.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul:</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-custom-save w-100">Simpan</button>
        </form>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('agenda.index') }}" class="btn btn-custom-back">Kembali</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
