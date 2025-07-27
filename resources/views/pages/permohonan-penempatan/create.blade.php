@extends('layouts.admin-app')

@section('head')
    <!-- Toastify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Form Permohonan Penempatan Prakerin</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('permohonan-penempatan.store') }}" class="px-5 pt-5 pb-2" enctype="multipart/form-data"
                method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tahun_ajaran">Tahun Ajaran:</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="tahun_ajaran" name="tahun_ajaran" required type="text" value="{{ old('tahun_ajaran') }}">
                    @error('tahun_ajaran')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>



                {{-- Perusahaan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="perusahaan_id">Perusahaan</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="perusahaan_id"
                        name="perusahaan_id" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($perusahaan as $item)
                            <option {{ old('perusahaan_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                    @error('perusahaan_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Guru --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="guru_id">Guru Pembimbing</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="guru_id" name="guru_id">
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($gurus as $item)
                            <option {{ old('guru_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->nama ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Instruktur --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="instruktur_id">Instruktur</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="instruktur_id"
                        name="instruktur_id">
                        <option value="">-- Pilih Instruktur --</option>
                        @foreach ($instrukturs as $item)
                            <option {{ old('instruktur_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->nama ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                    @error('instruktur_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Mulai --}}

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_mulai">Tanggal Mulai:</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="tanggal_mulai" name="tanggal_mulai" required type="date" value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_selesai">Tanggal Selesai:</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="tanggal_selesai" name="tanggal_selesai" required type="date"
                        value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alasan">Alasan (Opsional):</label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="alasan" name="alasan" rows="3">{{ old('alasan') }}</textarea>
                    @error('alasan')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div> --}}

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="file_pendukung">File Pendukung
                        (Opsional):</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="file_pendukung" name="file_pendukung" type="file">
                    @error('file_pendukung')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="!bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                        type="submit">
                        Simpan
                    </button>
                    <a class="ml-3 !bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 flex items-center justify-center"
                        href="{{ route('permohonan-penempatan.index') }}">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    Toastify({
                        text: @json($error),
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f87171",
                        stopOnFocus: true,
                    }).showToast();
                @endforeach
            });
        </script>
    @endif
@endpush
