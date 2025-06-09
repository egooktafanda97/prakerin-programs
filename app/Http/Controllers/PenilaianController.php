<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\PenempatanPrakerin;
use App\Models\Penilaian;
use App\Models\Siswa;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = Penilaian::class;
        $this->viewPath = 'pages.penilaian';
        $this->routePrefix = 'penilaian';
    }

    public function index()
    {
        $userCheck = auth()->user();
        $siswa = Siswa::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->where('status', 'aktif')
                    ->with([
                        'perusahaan',
                        'guru',
                        'instruktur'
                    ]);
            },
            'penilaian'
        ])
            ->when(!empty(request('kelas_id')), function ($query) {
                return $query->where('kelas', request('kelas_id'));
            })
            ->when(!empty(request('jurusan_id')), function ($query) {
                return $query->where('jurusan', request('jurusan_id'));
            })
            ->when(!empty(request('tahun_ajaran')), function ($query) {
                return $query->whereHas('penempatanPrakerin', function ($q) {
                    $q->where('tahun_ajaran', request('tahun_ajaran'));
                });
            })
            ->when(!empty(request('search')), function ($query) {
                return $query->where(function ($q) {
                    $q->where('nama', 'like', '%' . request('search') . '%')
                        ->orWhere('nis', 'like', '%' . request('search') . '%');
                });
            })
            ->when($userCheck->role == 'instruktur', function ($query) use ($userCheck) {
                return $query->whereHas('penempatanPrakerin', function ($q) use ($userCheck) {
                    $instruktur = Instruktur::where('user_id', $userCheck->id)->first();
                    $q->where('instruktur_id', $instruktur->id);
                });
            })

            ->when($userCheck->role == 'siswa', function ($query) use ($userCheck) {
                return $query->where('user_id', $userCheck->id);
            })
            ->get();
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
        $jurusanList = Siswa::select('jurusan')->distinct()->pluck('jurusan');
        return view("pages.penilaian.index", compact('siswa', 'kelasList', 'jurusanList'));
    }

    /**
     * create
     */
    public function create($id)
    {
        return view("{$this->viewPath}.create", [
            "siswa" => Siswa::with([
                'user',
                'penempatanPrakerin' => function ($q) {
                    $q->with([
                        'perusahaan',
                        'guru',
                        'instruktur'
                    ]);
                }
            ])->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        $siswa = Siswa::with([
            'penilaian'
        ])->findOrFail($id);


        return view("{$this->viewPath}.edit", [
            "siswa" => $siswa,

        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        $siswa =  Siswa::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->with([
                    'perusahaan',
                    'guru',
                    'instruktur'
                ]);
            }
        ])
            ->where('id', $request->input('siswa_id'))
            ->first();

        $rq = collect($validated)
            ->merge([
                'siswa_id' => $siswa->id,
                "penempatan_id" => $siswa->penempatanPrakerin->id,
                "instruktur_id" => $siswa->penempatanPrakerin->instruktur_id,
                "nilai_akhir" => ($validated['nilai_kehadiran'] + $validated['nilai_disiplin'] + $validated['nilai_kerjasama'] + $validated['nilai_inisiatif']) / 4,
            ])
            ->toArray();

        ($this->model)::create($rq);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        $siswa =  Siswa::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->with([
                    'perusahaan',
                    'guru',
                    'instruktur'
                ]);
            }
        ])
            ->where('id', $request->input('siswa_id'))
            ->first();

        $rq = collect($validated)
            ->merge([
                "penempatan_id" => $siswa->penempatanPrakerin->id,
                "instruktur_id" => $siswa->penempatanPrakerin->instruktur_id,
            ])
            ->toArray();
        $penilaian = Penilaian::where('siswa_id', $siswa->id)->firstOrFail();
        $penilaian->update($rq);
        $penilaian->nilai_akhir = ($penilaian->nilai_kehadiran + $penilaian->nilai_disiplin + $penilaian->nilai_kerjasama + $penilaian->nilai_inisiatif) / 4;
        $penilaian->save();
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = ($this->model)::findOrFail($id);
        $item->delete();
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil dihapus.');
    }

    protected function validationRules($id = null): array
    {
        return [
            'nilai_kehadiran' => 'required|integer|min:0|max:100',
            'nilai_disiplin' => 'required|integer|min:0|max:100',
            'nilai_kerjasama' => 'required|integer|min:0|max:100',
            'nilai_inisiatif' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ];
    }

    public function prints(Request $request)
    {

        $siswa = Siswa::with([
            'user',
            'penempatanPrakerin' => function ($q) {
                $q->with([
                    'perusahaan',
                    'guru',
                    'instruktur'
                ]);
            },
            'penilaian'
        ])
            ->when(!empty(request('kelas_id')), function ($query) {
                return $query->where('kelas', request('kelas_id'));
            })
            ->when(!empty(request('jurusan_id')), function ($query) {
                return $query->where('jurusan', request('jurusan_id'));
            })
            ->when(!empty(request('tahun_ajaran')), function ($query) {
                return $query->whereHas('penempatanPrakerin', function ($q) {
                    $q->where('tahun_ajaran', request('tahun_ajaran'));
                });
            })
            ->when(!empty(request('search')), function ($query) {
                return $query->where(function ($q) {
                    $q->where('nama', 'like', '%' . request('search') . '%')
                        ->orWhere('nis', 'like', '%' . request('search') . '%');
                });
            })
            ->get();
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
        $jurusanList = Siswa::select('jurusan')->distinct()->pluck('jurusan');
        return view("{$this->viewPath}.prints", compact('siswa'));
    }
}
