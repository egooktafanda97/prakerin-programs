<?php

namespace App\Http\Controllers;

use App\Models\DataNilaiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataNilaiController extends Controller
{
    public function index()
    {
        $data = DataNilaiSiswa::latest()->get();

        return view('pages.nilai_siswa.index', compact('data'));
    }

    public function show($id)
    {
        $item = DataNilaiSiswa::findOrFail($id);
        return view('pages.nilai_siswa.show', compact('item'));
    }

    public function create()
    {
        return view('pages.nilai_siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'dokument' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
            'keterangan' => 'nullable|string',
        ]);


        // Simpan file ke public/uploads/nilai_siswa
        $file = $request->file('dokument');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/nilai_siswa'), $filename);
        $path = 'uploads/nilai_siswa/' . $filename;

        // Simpan ke database
        DataNilaiSiswa::create([
            'nama_dokumen' => $request->nama_dokumen,
            'dokument' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('nilai-siswa.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $item = DataNilaiSiswa::findOrFail($id);
        return view('pages.nilai_siswa.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = DataNilaiSiswa::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'dokument' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('dokument')) {
            // Hapus file lama jika ada
            if ($item->dokument && file_exists(public_path($item->dokument))) {
                unlink(public_path($item->dokument));
            }

            $file = $request->file('dokument');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/nilai_siswa'), $filename);
            $item->dokument = 'uploads/nilai_siswa/' . $filename;
        }

        $item->nama_dokumen = $request->nama_dokumen;
        $item->keterangan = $request->keterangan;
        $item->save();

        return redirect()->route('nilai-siswa.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = DataNilaiSiswa::findOrFail($id);

        // Hapus file dari public jika ada
        if ($item->dokument && file_exists(public_path($item->dokument))) {
            unlink(public_path($item->dokument));
        }

        $item->delete();
        return redirect()->route('nilai-siswa.index')->with('success', 'Data berhasil dihapus.');
    }
}
