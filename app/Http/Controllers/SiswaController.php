<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\Siswa;
use App\Models\User;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = Siswa::class;
        $this->viewPath = 'pages.siswa';       // resources/views/siswa
        $this->routePrefix = 'siswa';    // route('siswa.index') dst
    }

    public function index()
    {


        $data = ($this->model)::latest()
            ->when(auth()->user()->role == 'instruktur', function ($query) {
                $instruktur = Instruktur::where('user_id', auth()->user()->id)->first();
                return $query->whereHas('penempatanPrakerin', function ($q) use ($instruktur) {
                    $q->where('instruktur_id', $instruktur->id);
                });
            })
            ->get()
            ->map(function ($item, $i) {
                $item->no = $i + 1;
                return $item;
            });
        return view("{$this->viewPath}.index", compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $UserData = User::create([
            'nama_lengkap' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
        $rq = collect($validated)->merge(['user_id' => $UserData->id])->toArray();

        ($this->model)::create($rq);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {


        $validated = $request->validate($this->validationRules($id));

        $item = ($this->model)::findOrFail($id);

        $cekUserUpdate = User::where('id', $item->user_id)->first();
        if ($cekUserUpdate->username != $request->username) {
            $cekUser = User::where('username', $request->username)->first();
            if ($cekUser) {
                return redirect()->back()->with('error', 'Username sudah terdaftar.');
            }
        }
        if ($cekUserUpdate->username != $request->username) {
            $cekUserUpdate->update([
                'username' => $request->username,
            ]);
        }
        if ($cekUserUpdate->nama_lengkap != $request->nama) {
            $cekUserUpdate->update([
                'nama_lengkap' => $request->nama,
            ]);
        }
        if ($cekUserUpdate->password != bcrypt('password')) {
            $cekUserUpdate->update([
                'password' => bcrypt('password'),
            ]);
        }
        $item->update($validated);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil diperbarui.');
    }


    protected function validationRules($id = null): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'nis' => 'required|unique:siswa,nis,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ];
    }
}
