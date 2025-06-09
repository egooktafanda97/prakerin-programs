<?php

namespace App\Http\Controllers;

use App\Models\LogbookPrakerin;
use App\Models\PenempatanPrakerin;
use App\Models\Siswa;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class LogbookPrakerinController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = LogbookPrakerin::class;
        $this->viewPath = 'pages.logbook_prakerin';
        $this->routePrefix = 'logbook-prakerin';
    }

    public function index($user_id = null)
    {
        $userIdTb = auth()->user()->role == 'siswa' ? auth()->user()->id : $user_id;
        $data = ($this->model)::latest()
            ->where("user_id", $userIdTb)
            ->get()
            ->map(function ($item, $i) {
                $item->no = $i + 1;
                return $item;
            });
        return view("{$this->viewPath}.index", compact('data'));
    }

    public function validasiInstruktur()
    {
        $data = ($this->model)::latest()
            ->get()
            ->map(function ($item, $i) {
                $item->no = $i + 1;
                return $item;
            });
        return view("pages.logbook_prakerin.valiadasi-instrutur", compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        $rq = collect($validated)
            ->merge([
                'penempatan_id' => Siswa::whereUserId($request->user()->id)
                    ->first()
                    ->penempatanPrakerin()
                    ->where('status', 'aktif')
                    ->first()
                    ->id,
                'user_id' => auth()->user()->id,
            ])
            ->toArray();

        ($this->model)::create($rq);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->validationRules($id));
        $item = ($this->model)::findOrFail($id);
        $item->update($validated);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $item = ($this->model)::findOrFail($id);
        $item->delete();
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil dihapus.');
    }
    public function show($id)
    {
        $item = ($this->model)::findOrFail($id);
        return view("{$this->viewPath}.show", compact('item'));
    }

    protected function validationRules($id = null): array
    {
        return [
            'tanggal' => 'required|date',
            'aktivitas' => 'required|string',
            'validasi_instruktur' => 'nullable|boolean',
            'validasi_instruktur_at' => 'nullable|date',
        ];
    }

    /**
     * isValidasi
     */
    public function isValidasi(Request $request, $id)
    {

        $data = ($this->model)::where('id', $id)
            ->first();
        $data->update([
            'validasi_instruktur' => $request->get('status') == 'Valid' ? 'Valid' : 'Tidak Valid',
            'validasi_instruktur_at' => $request->get('status') == 'Valid' ? now() : null,
        ]);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function laporanKegiatan($user_id = null)
    {
        $laporan = ($this->model)::latest()
            ->where("user_id", auth()->user()->id ?? $user_id)
            ->get()
            ->map(function ($item, $i) {
                $item->no = $i + 1;
                return $item;
            });
        $penempatanPrakerin = PenempatanPrakerin::where('siswa_id', auth()->user()->siswa->id)
            ->with([
                "siswa",
                "perusahaan",
                "guru",
                "instruktur",
            ])
            ->first();
        return view("{$this->viewPath}.prints", compact('laporan', 'penempatanPrakerin'));
    }
}
