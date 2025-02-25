@extends('layouts.app')
@section('content')

<style>
    .custom-header {
        background: linear-gradient(135deg, #dcdcdc, #f5f5f5); /* Gradasi abu-abu lembut */
        color: #333;
        font-weight: bold;
    }
    .btn-custom-save {
        background: linear-gradient(135deg, #6a9c78, #a5c9a4); /* Hijau olive lembut */
        color: white;
        border: none;
    }
    .btn-custom-save:hover {
        background: linear-gradient(135deg, #5a8c68, #94b894);
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header custom-header">
            <h3 class="mb-0">✏ Edit Agenda Sekolah</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('agenda.update', $agenda['id']) }}" method="POST">
                @csrf
                @method('PUT') 
                
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control border rounded" 
                           value="{{ old('judul', $agenda['judul']) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control border rounded" 
                              rows="4" required>{{ old('deskripsi', $agenda['deskripsi']) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control border rounded" 
                           value="{{ old('tanggal', $agenda['tanggal']) }}" required>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary">⬅ Kembali</a>
                    <button type="submit" class="btn btn-custom-save">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
