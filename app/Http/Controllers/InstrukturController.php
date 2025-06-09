<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\User;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = Instruktur::class;
        $this->viewPath = 'pages.instruktur';
        $this->routePrefix = 'instruktur';
    }


    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $UserData = User::create([
            'nama_lengkap' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'role' => 'instruktur',
        ]);

        ($this->model)::create(collect($validated)->merge(['user_id' => $UserData->id])->toArray());
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
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ];
    }
}
