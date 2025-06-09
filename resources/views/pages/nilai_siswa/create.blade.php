@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header pl-5 pr-5 pt-5 pb-0">
            <h4 class="card-title">Tambah Nilai Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai-siswa.store') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="nama_dokumen">Nama Dokumen</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="nama_dokumen"
                        name="nama_dokumen" required type="text">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="dokument">Upload File</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="dokument" name="dokument"
                        required type="file">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="keterangan">Keterangan</label>
                    <textarea class="mt-1 block w-full rounded border border-gray-300 p-2" id="keterangan" name="keterangan"
                        placeholder="Opsional..." rows="3"></textarea>
                </div>

                <div class="flex justify-end">
                    <a class="mr-2 text-gray-700 btn border-gray-300 hover:bg-gray-100"
                        href="{{ route('nilai-siswa.index') }}">Batal</a>
                    <button
                        class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-200"
                        type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
