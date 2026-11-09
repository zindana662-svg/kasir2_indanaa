<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jenjang;
use App\Models\Jurusan;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Filter search
        $kelas = Kelas::query()
            ->with(['jenjang', 'jurusan'])
            ->when(request('search'), function ($query, $search) {
                $query->where('nama_kelas', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();

        return view('kelas.create', compact('jenjang', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jenjang_id' => 'required|exists:jenjangs,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Kelas::create($data);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with(['jenjang', 'jurusan'])->findOrFail($id);

        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();

        return view('kelas.edit', compact('kelas', 'jenjang', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $data = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jenjang_id' => 'required|exists:jenjangs,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kelas->update($data);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
