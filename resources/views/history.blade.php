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

    /* Table */
    .table-custom thead {
        background: linear-gradient(135deg, #6a9c78, #a5c9a4); /* Hijau olive lembut */
        color: white;
        text-align: center;
    }

    /* Button lebih soft */
    .btn-custom-restore {
        background: linear-gradient(135deg, #6a9c78, #a5c9a4);
        color: white;
        border: none;
    }
    .btn-custom-restore:hover {
        background: linear-gradient(135deg, #5a8c68, #94b894);
    }

    .btn-custom-delete {
        background: linear-gradient(135deg, #d9534f, #f0938e); /* Merah soft */
        color: white;
        border: none;
    }
    .btn-custom-delete:hover {
        background: linear-gradient(135deg, #c12e2a, #e47c76);
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
        <h1 class="mb-0">Data Riwayat Agenda</h1>
    </div>

    <div class="card custom-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📜 Riwayat Agenda</h4>
            <a href="{{ route('agenda.index') }}" class="btn btn-custom-back">⬅ Kembali</a>
        </div>

        <table class="table table-bordered table-hover table-striped table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agenda as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td class="text-center">{{ $item->tanggal }}</td>
                        <td class="text-center">
                            <form action="{{ route('agenda.restore', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-custom-restore btn-sm">🔄 Restore</button>
                            </form>
                            <form action="{{ route('agenda.forcedelete', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-custom-delete btn-sm">🗑 Hapus Permanen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
