@extends('layouts.app')

@section('content')

<style>
    .custom-header {
        background: linear-gradient(135deg, #dcdcdc, #f5f5f5); /* Gradasi abu-abu lembut */
        color: #333;
        font-weight: bold;
        padding: 10px 15px;
        border-radius: 10px 10px 0 0;
    }
    .btn-custom-add {
        background: linear-gradient(135deg, #6a9c78, #a5c9a4); /* Hijau olive lembut */
        color: white;
        border: none;
    }
    .btn-custom-add:hover {
        background: linear-gradient(135deg, #5a8c68, #94b894);
    }
    .btn-custom-history {
        background: linear-gradient(135deg, #8c8c8c, #bfbfbf); /* Abu-abu soft */
        color: white;
        border: none;
    }
    .btn-custom-history:hover {
        background: linear-gradient(135deg, #7a7a7a, #a5a5a5);
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1 !important;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="custom-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">📅 Daftar Agenda Sekolah</h3>
                <p class="mb-0">Total Agenda: <strong>{{ $agendas->count() }}</strong></p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="d-flex gap-2 mb-3">
                <a href="{{ route('agenda.create') }}" class="btn btn-custom-add">
                    <i class="fa-solid fa-plus"></i> Tambah Agenda
                </a>
                <a href="{{ route('agenda.history') }}" class="btn btn-custom-history">
                    <i class="fa-solid fa-clock-rotate-left"></i> History
                </a>
            </div>

            <table id="agendaTable" class="table table-bordered table-hover table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agendas as $agenda)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $agenda->judul }}</td>
                        <td>{{ $agenda->deskripsi }}</td>
                        <td class="text-center">
                            <img src="{{ asset($agenda->image) }}" alt="{{ $agenda->judul }}" 
                                 class="img-thumbnail clickable-image" 
                                 style="max-width: 80px; cursor: pointer;"
                                 data-bs-toggle="modal" data-bs-target="#imageModal"
                                 onclick="showImageModal('{{ asset($agenda->image) }}')">
                        </td>
                        <td class="text-center">{{ $agenda->tanggal }}</td>
                        <td class="text-center">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                        @endif 
                            @if(Auth::user()->role == 'admin')
                                <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" 
                                      onsubmit="return confirmDelete()" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑 Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Bootstrap untuk gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#agendaTable').DataTable();
    });

    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus agenda ini?");
    }

    function showImageModal(imageUrl) {
        document.getElementById("modalImage").src = imageUrl;
    }
</script>

@endsection
