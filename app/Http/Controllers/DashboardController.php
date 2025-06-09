<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Instruktur;
use App\Models\Perusahaan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        if (auth()->user()->role == 'siswa') {
            return $this->showSiswa();
        } else if (auth()->user()->role == 'guru') {
            return $this->showGuru();
        } else if (auth()->user()->role == 'instruktur') {
            return $this->showInstruktur();
        } else {
            return view('pages.dashboard.index', [
                "data" => Perusahaan::all()
            ]);
        }
    }

    public function showGuru()
    {
        $item = Guru::with([
            'user',
        ])
            ->where("user_id", auth()->user()->id)
            ->first();
        $data = Perusahaan::all();
        return view('pages.dashboard.guru', compact('item', 'data'));
    }

    public function showSiswa()
    {
        $item = Siswa::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->with(['perusahaan', 'guru', 'instruktur']);
            },
            'penilaian'
        ])
            ->where("user_id", auth()->user()->id)
            ->first();
        $data = Perusahaan::all();
        return view('pages.dashboard.siswa', compact('item', 'data'));
    }

    public function showInstruktur()
    {
        $item = Instruktur::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->with(['perusahaan', 'guru', 'siswa']);
            },
        ])
            ->where("user_id", auth()->user()->id)
            ->first();
        $data = Perusahaan::all();
        return view('pages.dashboard.instruktur', compact('item', 'data'));
    }
}
