@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header pl-5 pr-5 pt-5 pb-0">
            <h4 class="card-title">Edit Nilai Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai-siswa.update', $item->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="nama_dokumen">Nama Dokumen</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="nama_dokumen"
                        name="nama_dokumen" required type="text" value="{{ old('nama_dokumen', $item->nama_dokumen) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="dokument">Upload File <small>(biarkan kosong
                            jika tidak ingin mengganti file)</small></label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="dokument" name="dokument"
                        type="file">
                    @if ($item->dokument)
                        <p class="mt-2 text-sm text-gray-500">File saat ini:
                            <a class="text-blue-600 underline" href="{{ asset($item->dokument) }}" target="_blank">
                                {{ basename($item->dokument) }}
                            </a>
                        </p>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="keterangan">Keterangan</label>
                    <textarea class="mt-1 block w-full rounded border border-gray-300 p-2" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $item->keterangan) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a class="mr-2 text-gray-700 btn border-gray-300 hover:bg-gray-100"
                        href="{{ route('nilai-siswa.index') }}">Batal</a>
                    <button
                        class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:ring focus:ring-custom-200"
                        type="submit">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
