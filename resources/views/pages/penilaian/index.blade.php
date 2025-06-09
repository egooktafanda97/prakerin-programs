@extends('layouts.admin-app')
@section('content')
    <style>
        /* Untuk semua sel tabel (header dan data) */
        th,
        td {
            padding: 3px !important;
            white-space: nowrap;
            border: 1px solid #ddd;
        }

        /* Jika Anda ingin menghilangkan padding dan border agar lebih compact */
        table {
            border-collapse: collapse;
            width: 100%;
            /* Penting: agar tabel bisa melebar jika kontennya panjang */
        }
    </style>
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Nilai Siswa</h4>

            </div>
        </div>
        <div class="card-body">
            <form class="px-5 mb-5 grid grid-cols-1 md:grid-cols-4 gap-4" method="GET">
                <div>
                    <label class="block mb-1 text-sm font-medium" for="kelas_id">Kelas</label>
                    <select
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-blue-500 focus:border-blue-500"
                        id="kelas_id" name="kelas_id">
                        <option value="">Semua</option>
                        @foreach ($kelasList as $k)
                            <option value="{{ $k }}">
                                {{ $k }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium" for="jurusan_id">Jurusan</label>
                    <select
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-blue-500 focus:border-blue-500"
                        id="jurusan_id" name="jurusan_id">
                        <option value="">Semua</option>
                        @foreach ($jurusanList as $j)
                            <option value="{{ $j }}">
                                {{ $j }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium" for="tahun_ajaran">Tahun Ajaran</label>
                    <input
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-blue-500 focus:border-blue-500"
                        id="tahun_ajaran" name="tahun_ajaran" placeholder="2024/2025" type="text"
                        value="{{ request('tahun_ajaran') }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium" for="search">Cari Nama</label>
                    <input
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-blue-500 focus:border-blue-500"
                        id="search" name="search" placeholder="Nama Siswa" type="text"
                        value="{{ request('search') }}">
                </div>

                <div class="md:col-span-4 text-right">
                    <button
                        class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                        type="submit">
                        Filter
                    </button>
                    <a class="text-white bg-orange-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                        href="{{ route('penilaian.print', request()->all()) }}" target="_blank">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </form>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-1 px-3 text-left">No</th>
                            <th class="py-1 px-3 text-left">Nama Siswa</th>
                            <th class="py-1 px-3 text-left">Kelas</th>
                            <th class="py-1 px-3 text-left">Tahun Ajaran</th>
                            <th class="py-1 px-3 text-left">Penempatan</th>
                            <th class="py-1 px-3 text-left">Instruktur</th>
                            <th class="py-1 px-3 text-left">Nilai Kehadiran</th>
                            <th class="py-1 px-3 text-left">Nilai Kedisiplinan</th>
                            <th class="py-1 px-3 text-left">Nilai Kerjasama</th>
                            <th class="py-1 px-3 text-left">Nilai Inisiatif</th>
                            <th class="py-1 px-3 text-left">Nilai Akhir</th>
                            <th class="py-1 px-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($siswa as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-1 px-3 text-left">{{ $loop->iteration }}</td>
                                <td class="py-1 px-3 text-left">{{ $item->nama }}</td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item->kelas ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item->penempatanPrakerin->tahun_ajaran ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item->penempatanPrakerin->perusahaan->nama_perusahaan ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item->penempatanPrakerin->instruktur->nama ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item?->penilaian?->nilai_kehadiran ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item?->penilaian?->nilai_disiplin ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item?->penilaian?->nilai_kerjasama ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-left">
                                    {{ $item?->penilaian?->nilai_inisiatif ?? '-' }}
                                </td>

                                <td class="py-1 px-3 text-left">
                                    {{ $item?->penilaian?->nilai_akhir ?? '-' }}
                                </td>
                                <td class="py-1 px-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        @if (auth()->user()->role == 'instruktur')
                                            @if ($item->penilaian)
                                                <a class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                                    href="{{ route('penilaian.edit', $item->id) }}"
                                                    style="width: 150px">Edit
                                                    Nilai</a>
                                            @else
                                                <a class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                                    href="{{ route('penilaian.create', $item->id) }}" style="width: 150px">
                                                    Buat Nilai
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
