<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CrudViewTrait
{
    protected string $viewPath; // contoh: 'siswa', 'guru'
    protected string $routePrefix; // contoh: 'siswa', 'guru'
    protected string $model; // App\Models\NamaModel

    /**
     * Tampilkan semua data
     */
    public function index()
    {
        $data = ($this->model)::latest()->get();
        return view("{$this->viewPath}.index", compact('data'));
    }

    /**
     * Tampilkan form tambah
     */
    public function create()
    {
        return view("{$this->viewPath}.create");
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        ($this->model)::create($validated);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $item = ($this->model)::findOrFail($id);
        return view("{$this->viewPath}.edit", compact('item'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->validationRules($id));
        $item = ($this->model)::findOrFail($id);
        $item->update($validated);
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = ($this->model)::findOrFail($id);
        $item->delete();
        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Aturan validasi default (wajib override di controller jika perlu)
     */
    abstract function validationRules($id = null): array;
    /**
     * Aturan validasi untuk create (wajib override di controller jika perlu)
     */
}
