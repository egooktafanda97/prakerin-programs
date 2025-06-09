<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = Guru::class;
        $this->viewPath = 'pages.guru';  // resources/views/guru
        $this->routePrefix = 'guru';     // route('guru.index') etc.
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $UserData = User::create([
            'nama_lengkap' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'role' => 'guru',
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
            'nip' => 'required|unique:guru,nip,' . $id,
            'nama' => 'required',
            'mata_pelajaran' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ];
    }
}
