@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Edit Penempatan Prakerin</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('penempatan.update', $item->id) }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf
                @method('PUT')

                {{-- Tahun Ajaran --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="tahun_ajaran">Tahun Ajaran</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="tahun_ajaran"
                        name="tahun_ajaran" placeholder="Contoh: 2024/2025" required type="text"
                        value="{{ old('tahun_ajaran', $item->tahun_ajaran) }}">
                </div>

                {{-- Siswa --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="siswa_id">Siswa</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="siswa_id" name="siswa_id"
                        required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $option)
                            <option {{ old('siswa_id', $item->siswa_id) == $option->id ? 'selected' : '' }}
                                value="{{ $option->id }}">
                                {{ $option->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Perusahaan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="perusahaan_id">Perusahaan</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="perusahaan_id"
                        name="perusahaan_id" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($perusahaan as $option)
                            <option {{ old('perusahaan_id', $item->perusahaan_id) == $option->id ? 'selected' : '' }}
                                value="{{ $option->id }}">
                                {{ $option->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Guru --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="guru_id">Guru Pembimbing</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="guru_id" name="guru_id"
                        required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($guru as $option)
                            <option {{ old('guru_id', $item->guru_id) == $option->id ? 'selected' : '' }}
                                value="{{ $option->id }}">
                                {{ $option->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Instruktur --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="instruktur_id">Instruktur</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="instruktur_id"
                        name="instruktur_id" required>
                        <option value="">-- Pilih Instruktur --</option>
                        @foreach ($instruktur as $option)
                            <option {{ old('instruktur_id', $item->instruktur_id) == $option->id ? 'selected' : '' }}
                                value="{{ $option->id }}">
                                {{ $option->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Mulai --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="tanggal_mulai">Tanggal Mulai</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="tanggal_mulai"
                        name="tanggal_mulai" required type="date"
                        value="{{ old('tanggal_mulai', $item->tanggal_mulai) }}">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="tanggal_selesai">Tanggal Selesai</label>
                    <input class="mt-1 block w-full rounded border border-gray-300 p-2" id="tanggal_selesai"
                        name="tanggal_selesai" required type="date"
                        value="{{ old('tanggal_selesai', $item->tanggal_selesai) }}">
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="status">Status</label>
                    <select class="mt-1 block w-full rounded border border-gray-300 p-2" id="status" name="status"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option {{ old('status', $item->status) == 'aktif' ? 'selected' : '' }} value="aktif">Aktif
                        </option>
                        <option {{ old('status', $item->status) == 'selesai' ? 'selected' : '' }} value="selesai">
                            Selesai</option>
                        <option {{ old('status', $item->status) == 'pending' ? 'selected' : '' }} value="pending">
                            Pending</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="!bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                        type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
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
