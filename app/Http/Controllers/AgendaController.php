<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index()
    {
        $agendas = Agenda::all();
        return view('index', compact('agendas')); // Ubah dari 'agenda.index' ke 'index'
    }

    public function create()
    {
        return view('create'); // Ubah dari 'agenda.create' ke 'create'
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahan validasi format gambar
        ]);
    
         // Inisialisasi imageUrl sebagai null
    
        $image = $request->file('image');
        $imagename = uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images', $imagename);
        $imageUrl = Storage::url($imagePath);
    
        // Simpan data ke database
        Agenda::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'image' => $imageUrl, // Pastikan nama kolom sama dengan database
        ]);
    
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->fill($request->only(['judul', 'deskripsi', 'tanggal']));
        $agenda->save(); // Simpan perubahan

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus!'); // Perbaikan di sini
    }

    public function restore($id)
    {
        $agenda = Agenda::withTrashed()->find($id);
        if ($agenda && $agenda->trashed()) {
            $agenda->restore();
            return redirect()->route('agenda.index')->with('success', 'Buku dikembalikan!');
        }
        return redirect()->route('agenda.index')->with('error', 'Buku tidak ditemukan atau tidak dihapus!');
    }

    public function forcedelete($id)
    {
        $agenda = Agenda::withTrashed()->find($id);
        if ($agenda && $agenda->trashed()) {
            $agenda->forceDelete();
            return redirect()->route('agenda.index')->with('Berhasil','buku dihapus permanen!');
        }
        return redirect()->route('agenda.index')->with('error', 'Buku tidak ditemukan atau tidak dihapus!');
    }

    public function history()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }
    
        $agenda = Agenda::onlyTrashed()->get();
        return view('history', compact('agenda'));
    }
}
