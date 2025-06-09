<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\User;
use App\Traits\CrudViewTrait;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    use CrudViewTrait;

    public function __construct()
    {
        $this->model = Perusahaan::class;
        $this->viewPath = 'pages.perusahaan';
        $this->routePrefix = 'perusahaan';
    }


    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $UserData = User::create([
            'nama_lengkap' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt('password'),
            'role' => 'perusahaan',
        ]);
        $rq = collect($validated)->merge(['user_id' => $UserData->id])->toArray();

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

    protected function validationRules($id = null): array
    {
        return [
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'bidang_usaha' => 'required',
            'koordinat' => 'nullable|string|max:255'
        ];
    }
}
