<?php

namespace App\Http\Controllers;

use App\Models\DataNilaiSiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('website', compact('perusahaan'));
    }

    public function showTableNilai()
    {
        $data = DataNilaiSiswa::latest()->get();
        return view('show-table-nilai', compact('data'));
    }
}
