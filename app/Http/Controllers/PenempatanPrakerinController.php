<?php

namespace App\Http\Controllers;

use App\Models\PenempatanPrakerin;
use App\Traits\CrudViewTrait;

class PenempatanPrakerinController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = PenempatanPrakerin::class;
        $this->viewPath = 'pages.penempatan';
        $this->routePrefix = 'penempatan-prakerin';
    }

    public function index()
    {
        $data = ($this->model)::latest()
            ->with([
                "siswa",
                "perusahaan",
                "guru",
                "instruktur",
            ])
            ->get();
        return view("{$this->viewPath}.index", compact('data'));
    }

    protected function validationRules($id = null): array
    {
        return [
            'tahun_ajaran' => 'required|string',
            'siswa_id' => 'required|exists:siswa,id',
            'perusahaan_id' => 'required|exists:perusahaan,id',
            'guru_id' => 'required|exists:guru,id',
            'instruktur_id' => 'required|exists:instruktur,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required',
        ];
    }

    /**
     * create
     */
    public function create()
    {
        $data = [
            'siswa' => \App\Models\Siswa::all(),
            'perusahaan' => \App\Models\Perusahaan::all(),
            'guru' => \App\Models\Guru::all(),
            'instruktur' => \App\Models\Instruktur::all(),
        ];
        return view("{$this->viewPath}.create", $data);
    }

    /**
     * edit
     */
    public function edit($id)
    {
        $item = ($this->model)::findOrFail($id);
        $data = [
            'siswa' => \App\Models\Siswa::all(),
            'perusahaan' => \App\Models\Perusahaan::all(),
            'guru' => \App\Models\Guru::all(),
            'instruktur' => \App\Models\Instruktur::all(),
        ];
        return view("{$this->viewPath}.edit", compact('item') + $data);
    }
}
