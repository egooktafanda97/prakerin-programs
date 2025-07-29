<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPenempatan;
use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Guru;
use App\Models\Instruktur;
use App\Models\PenempatanPrakerin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanPenempatanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan penempatan.
     * Dibatasi hanya 3 pengajuan terbaru seperti yang diminta.
     */
    public function index()
    {
        // Mengambil hanya 3 pengajuan penempatan terbaru dengan eager loading relasi
        $pengajuanPenempatans = PengajuanPenempatan::with(['siswa', 'perusahaan', 'guru', 'instruktur'])
            ->where('siswa_id', auth()->user()->siswa->id) // Hanya ambil pengajuan milik siswa yang sedang login
            ->latest()
            ->limit(3)
            ->get();

        $jumlahPengajuan = PengajuanPenempatan::where('siswa_id', auth()->user()->siswa->id)->count();
        // cek apakah sudah ada pengajuan yang di terima
        $pengajuanDiterima = PengajuanPenempatan::where('siswa_id', auth()->user()->siswa->id)
            ->where('status', 'diterima')
            ->exists();

        return view('pages.permohonan-penempatan.index', compact('pengajuanPenempatans', 'jumlahPengajuan', 'pengajuanDiterima'));
    }

    /**
     * Menampilkan daftar pengajuan penempatan yang telah diajukan oleh siswa.
     */
    public function daftarPengajuan()
    {
        // Mengambil semua pengajuan penempatan milik siswa yang sedang login dengan eager loading relasi
        $pengajuanPenempatans = PengajuanPenempatan::with(['siswa', 'perusahaan', 'guru', 'instruktur'])
            ->where('status', 'menunggu') // Hanya ambil pengajuan yang masih menunggu
            ->orderBy('tanggal_pengajuan', 'asc') // Urutkan berdasarkan tanggal pengajuan terbaru
            ->latest()
            ->get();
        // Ambil data yang diperlukan untuk dropdown/select di form
        $perusahaan = Perusahaan::all();
        $gurus = Guru::all();
        $instrukturs = Instruktur::all();

        return view('pages.permohonan-penempatan.daftar-pengajuan', compact('pengajuanPenempatans', 'perusahaan', 'gurus', 'instrukturs'));
    }
    /**
     * Menampilkan formulir untuk membuat pengajuan penempatan baru.
     */
    public function create()
    {
        // Ambil data yang diperlukan untuk dropdown/select di form
        $perusahaan = Perusahaan::all();
        $gurus = Guru::all();
        $instrukturs = Instruktur::all();

        return view('pages.permohonan-penempatan.create', compact('perusahaan', 'gurus', 'instrukturs'));
    }

    /**
     * Menyimpan pengajuan penempatan yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'perusahaan_id' => 'required',
            'guru_id' => 'nullable',
            'instruktur_id' => 'nullable',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            // 'alasan' => 'nullable|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,jpg,png', // Contoh validasi file
        ]);

        $data = $request->except('file_pendukung');

        // Handle file upload jika ada
        if ($request->hasFile('file_pendukung')) {
            $fileName = time() . '.' . $request->file('file_pendukung')->extension();
            $request->file('file_pendukung')->storeAs('public/files', $fileName);
            $data['file_pendukung'] = $fileName;
        }

        $data['tanggal_pengajuan'] = now();
        $data['status'] = 'menunggu'; // Status awal
        $data['siswa_id'] = auth()->user()->siswa->id; // Asumsi siswa_id diambil dari user yang sedang login


        PengajuanPenempatan::create($data);

        // Menggunakan nama rute yang benar: permohonan-penempatan.index
        return redirect()->route('permohonan-penempatan.index')->with('success', 'Pengajuan penempatan berhasil ditambahkan!');
    }

    /**
     * update pengjuan dari admin 
     * @deprecated Use the store method for creating new entries instead.
     */
    public function updatePengajuan(Request $request, string $id)
    {
        $pengajuanPenempatan = PengajuanPenempatan::findOrFail($id);
        // Validasi data yang masuk
        $request->validate([
            'alasan' => 'nullable|string|max:255',
            'status' => 'required|in:diterima,ditolak,menunggu',
            'guru_id' => 'nullable',
            'instruktur_id' => 'nullable',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);
        $data = $request->only(['status', 'alasan', 'guru_id', 'instruktur_id', 'tanggal_mulai', 'tanggal_selesai']);
        if ($data['status'] === 'diterima') {
            $data['tanggal_diterima'] = now();

            $xdata = [
                "tahun_ajaran" => $pengajuanPenempatan->tahun_ajaran,
                "siswa_id" => $pengajuanPenempatan->siswa_id,
                "perusahaan_id" => $pengajuanPenempatan->perusahaan_id,
                "guru_id" => $request->guru_id,
                "instruktur_id" => $request->instruktur_id,
                "tanggal_mulai" => $request->tanggal_mulai,
                "tanggal_selesai" => $request->tanggal_selesai,
                "status" => 'aktif' // Status aktif untuk penempatan prakerin
            ];
            $cekPengajuan = PenempatanPrakerin::where('siswa_id', $pengajuanPenempatan->siswa_id)
                ->where('status', 'aktif')
                ->first();
            if (!$cekPengajuan)    PenempatanPrakerin::create($xdata);
        } elseif ($data['status'] === 'ditolak') {
            $data['tanggal_ditolak'] = now();
        }
        $pengajuanPenempatan->update($data);
        // Menggunakan nama rute yang benar: permohonan-penempatan.index
        // return redirect()->route('permohonan-penempatan.daftar-pengajuan')->with('success', 'Pengajuan penempatan berhasil diperbarui!');
        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan penempatan berhasil diperbarui!',
            'data' => $pengajuanPenempatan
        ]);
    }

    /**
     * Menampilkan formulir untuk mengedit pengajuan penempatan tertentu.
     */
    public function edit(string $id)
    {

        $pengajuanPenempatan = PengajuanPenempatan::findOrFail($id);
        // Ambil data yang diperlukan untuk dropdown/select di form
        $siswas = Siswa::all();
        $perusahaan = Perusahaan::all();
        $gurus = Guru::all();
        $instrukturs = Instruktur::all();

        return view('pages.permohonan-penempatan.edit', compact('pengajuanPenempatan', 'siswas', 'perusahaan', 'gurus', 'instrukturs'));
    }

    /**
     * Memperbarui pengajuan penempatan tertentu di database.
     */
    public function update(Request $request, string $id)
    {
        $pengajuanPenempatan = PengajuanPenempatan::findOrFail($id);

        // Validasi data yang masuk
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'perusahaan_id' => 'required',
            'guru_id' => 'nullable',
            'instruktur_id' => 'nullable',
            'alasan' => 'nullable|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        $data = $request->except('file_pendukung');

        // Handle file upload jika ada
        if ($request->hasFile('file_pendukung')) {
            // Hapus file lama jika ada
            if ($pengajuanPenempatan->file_pendukung) {
                Storage::delete('public/files/' . $pengajuanPenempatan->file_pendukung);
            }
            $fileName = time() . '.' . $request->file('file_pendukung')->extension();
            $request->file('file_pendukung')->storeAs('public/files', $fileName);
            $data['file_pendukung'] = $fileName;
        }


        $pengajuanPenempatan->update($data);

        // Menggunakan nama rute yang benar: permohonan-penempatan.index
        return redirect()->route('permohonan-penempatan.index')->with('success', 'Pengajuan penempatan berhasil diperbarui!');
    }

    /**
     * Menghapus pengajuan penempatan tertentu dari database.
     */
    public function destroy($id)
    {
        $pengajuanPenempatan = PengajuanPenempatan::findOrFail($id);

        // Hapus file pendukung jika ada
        // if ($pengajuanPenempatan->file_pendukung) {
        //     Storage::delete('public/files/' . $pengajuanPenempatan->file_pendukung);
        // }

        $pengajuanPenempatan->delete();

        // Menggunakan nama rute yang benar: permohonan-penempatan.index
        return redirect()->route('permohonan-penempatan.index')->with('success', 'Pengajuan penempatan berhasil dihapus!');
    }
}
