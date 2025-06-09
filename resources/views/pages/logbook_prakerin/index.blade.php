@extends('layouts.admin-app')
@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Log Aktifitas</h4>
                @if (auth()->user()->role == 'siswa')
                    <a class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                        href="{{ route('logbook-prakerin.create') }}">Tambah Aktifitas</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Kegiatan</th>
                        <th class="py-3 px-6 text-left">Tanggal</th>
                        <th class="py-3 px-6 text-left">Validasi Instruktur</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($data as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->aktivitas }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->tanggal }}</td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    @if ($item->validasi_instruktur == 'Valid')
                                        <span class="text-green-500">Valid</span>
                                    @elseif ($item->validasi_instruktur == 'Tidak Valid')
                                        <span class="text-red-500">Tidak Valid</span>
                                    @else
                                        <span class="text-red-500">Belum Diverifikasi</span>
                                    @endif

                                    @if (auth()->user()->role == 'instruktur' &&
                                            ($item->validasi_instruktur == 'Belum Divalidasi' || $item->validasi_instruktur == 'Tidak Valid'))
                                        <form action="{{ route('logbook-prakerin.isvalidasi', $item->id) }}" class="ml-2"
                                            method="POST">
                                            @csrf
                                            <select
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                name="status" onchange="this.form.submit()">
                                                <option disabled selected>Pilih Status</option>
                                                <option {{ $item->status_validasi === 'Valid' ? 'selected' : '' }}
                                                    value="Valid">Valid</option>
                                                <option {{ $item->status_validasi === 'Tidak Valid' ? 'selected' : '' }}
                                                    value="Tidak Valid">Tidak Valid</option>
                                            </select>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $item->created_at }}</td>
                            <td class="py-3 px-6 text-center">
                                @if ($item->validasi_instruktur != 'Valid' && auth()->user()->role == 'siswa')
                                    <div class="flex justify-center gap-2">
                                        <a class="text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20"
                                            href="{{ route('logbook-prakerin.edit', $item->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('logbook-prakerin.destroy', $item->id) }}" class="inline"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20"
                                                type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
