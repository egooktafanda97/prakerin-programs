@extends('layouts.admin-app')

@section('head')
    <!-- Grid.js CSS -->
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <!-- Toastify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">
                    Permohonan Penempatan Prakerin
                </h4>
                @if ($jumlahPengajuan < 3 && !$pengajuanDiterima)
                    <a class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                        href="{{ route('permohonan-penempatan.create') }}">
                        Tambah Permohonan Penempatan
                    </a>
                @else
                    <span class="text-red-500">
                        {{ $jumlahPengajuan >= 3 ? 'Anda sudah mencapai batas maksimal pengajuan.' : '' }}
                        {{ $pengajuanDiterima ? 'Anda sudah memiliki pengajuan yang diterima.' : '' }}
                    </span>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div id="GridWrapper"></div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Grid.js JS -->
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function getData() {
            try {
                // Pastikan data diubah menjadi JSON string yang valid
                return JSON.parse('{!! $pengajuanPenempatans->toJson() !!}');
            } catch (error) {
                console.error("Error parsing JSON data:", error);
                return [];
            }
        }

        const pengajuanData = getData();
        console.log(pengajuanData);

        new gridjs.Grid({
            search: true,
            pagination: {
                limit: 5, // Batasi tampilan per halaman jika ada lebih dari 3 data (meskipun controller hanya mengambil 3)
                summary: true
            },
            sort: true,
            resizable: true,
            columns: [{
                    name: "Tahun Ajaran",
                    formatter: (cell) => cell || 'N/A'
                },
                {
                    name: "Siswa",
                    // Mengakses nama siswa dari objek relasi
                    formatter: (cell, row) => row.cells[1].data.siswa ? row.cells[1].data.siswa.nama : 'N/A'
                },
                {
                    name: "Perusahaan",
                    // Mengakses nama perusahaan dari objek relasi
                    formatter: (cell, row) => row.cells[2].data.perusahaan ? row.cells[2].data.perusahaan
                        .nama_perusahaan : 'N/A'
                },
                {
                    name: "Guru Pembimbing",
                    // Mengakses nama guru dari objek relasi
                    formatter: (cell, row) => row.cells[3].data.guru ? row.cells[3].data.guru.nama : 'N/A'
                },
                {
                    name: "Instruktur",
                    // Mengakses nama instruktur dari objek relasi
                    formatter: (cell, row) => row.cells[4].data.instruktur ? row.cells[4].data.instruktur.nama :
                        'N/A'
                },
                {
                    name: "Tanggal Mulai",
                    formatter: (cell) => cell ? new Date(cell).toLocaleDateString('id-ID') : 'N/A'
                },
                {
                    name: "Tanggal Selesai",
                    formatter: (cell) => cell ? new Date(cell).toLocaleDateString('id-ID') : 'N/A'
                },
                {
                    name: "Status",
                    formatter: (cell) => {
                        let statusClass = '';
                        if (cell === 'menunggu') {
                            statusClass = 'bg-yellow-200 text-yellow-800';
                        } else if (cell === 'diterima') {
                            statusClass = 'bg-green-200 text-green-800';
                        } else {
                            statusClass = 'bg-red-200 text-red-800';
                        }
                        return gridjs.html(
                            `<span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${cell.charAt(0).toUpperCase() + cell.slice(1)}</span>`
                        );
                    }
                },
                {
                    name: "Tanggal Pengajuan",
                    formatter: (cell) => cell ? new Date(cell).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }) : 'N/A'
                },
                {
                    name: "Alasan",
                    formatter: (cell) => cell || 'Tidak ada'
                },
                {
                    name: "File Pendukung",
                    formatter: (cell) => cell ? gridjs.html(
                        `<a href="{{ asset('storage/files/') }}/${cell}" target="_blank" class="text-blue-500 hover:underline">Lihat File</a>`
                    ) : 'Tidak ada'
                },
                {
                    name: "Action",
                    sort: false,
                    formatter: (cell, row) => {
                        // Mengambil seluruh objek item dari elemen terakhir di array data baris
                        // Perhatikan indeksnya disesuaikan karena penambahan kolom Tanggal Mulai dan Selesai
                        const item = row.cells[11].data;

                        // Admin view: Edit, Delete, dan Ubah Status selalu tersedia
                        let actionButtonsHtml = `
                            <a href="/pengajuan-penempatan/${item.id}/edit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 rounded-md">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="/pengajuan-penempatan/destroy/${item.id}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 rounded-md">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <button onclick="showStatusChangeDialog('${item.id}', '${item.status}', '${item.alasan || ''}')" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-blue-500 border-blue-500 hover:text-white hover:bg-blue-600 hover:border-blue-600 focus:text-white focus:bg-blue-600 focus:border-blue-600 focus:ring focus:ring-blue-100 active:text-white active:bg-blue-600 active:border-blue-600 active:ring active:ring-blue-100 dark:ring-blue-400/20 rounded-md">
                                <i class="fa fa-sync-alt"></i>
                            </button>
                        `;
                        return gridjs.html(actionButtonsHtml);
                    }
                }
            ],
            data: pengajuanData.map((item) => {
                // console.log(item); // Debugging: pastikan item memiliki semua properti yang diharapkan

                return [
                    item.tahun_ajaran,
                    item, // Objek siswa untuk formatter (index 1)
                    item, // Objek perusahaan untuk formatter (index 2)
                    item, // Objek guru untuk formatter (index 3)
                    item, // Objek instruktur untuk formatter (index 4)
                    item.tanggal_mulai,
                    item.tanggal_selesai,
                    item.status,
                    item.tanggal_pengajuan,
                    item.alasan,
                    item.file_pendukung,
                    item // Objek lengkap untuk tombol aksi (index 11)
                ];
            }),
        }).render(document.getElementById("GridWrapper"));

        // Toastify for success messages
        @if (session('success'))
            Toastify({
                text: @json(session('success')),
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4CAF50", // Green for success
                stopOnFocus: true,
            }).showToast();
        @endif
    </script>
@endpush
