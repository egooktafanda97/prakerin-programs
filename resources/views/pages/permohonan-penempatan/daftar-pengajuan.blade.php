@extends('layouts.admin-app')

@section('head')
    <!-- Grid.js CSS -->
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <!-- Toastify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet" type="text/css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">
                    Permohonan Penempatan Prakerin
                </h4>
                {{-- Tombol Tambah Permohonan Penempatan hanya jika ini adalah view siswa --}}
                {{-- Jika ini adalah daftar permohonan untuk admin, tombol ini mungkin tidak diperlukan di sini,
                     atau perlu logika berbeda (misal: tombol untuk siswa membuat permohonan baru) --}}
                {{-- Saya akan tetap menyertakannya sesuai kode Anda sebelumnya,
                     namun perlu diperhatikan konteks "daftar permohonan yang masuk ke admin" --}}

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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const gurus = @json($gurus);
        const instrukturs = @json($instrukturs);

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
                        const item = row.cells[11]
                            .data; // Mengambil seluruh objek item dari elemen terakhir di array data baris
                        return gridjs.html(
                            `<div class="flex gap-2">
                                <button onclick="showStatusChangeDialog('${item.id}', '${item.status}', '${item.alasan || ''}')" class="flex items-center justify-center px-3 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 rounded-md">
                                    <i class="fa fa-edit mr-3"></i> Ubah Status
                                </button>
                            </div>`
                        );
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

        // Function to show SweetAlert2 dialog for status change
        // Function to show SweetAlert2 dialog for status change
        // Function to show SweetAlert2 dialog for status change
        async function showStatusChangeDialog(id, currentStatus, currentAlasan) {
            // Dynamically generate options for Guru Pembimbing
            const guruOptions = gurus.map(guru => `
                <option value="${guru.id}" >
                    ${guru.nama ?? 'N/A'}
                </option>
            `).join('');

            // Dynamically generate options for Instruktur
            const instrukturOptions = instrukturs.map(instruktur => `
        <option value="${instruktur.id}" >
            ${instruktur.nama ?? 'N/A'}
        </option>
    `).join('');

            const {
                value: formValues
            } = await Swal.fire({
                title: 'Ubah Status Pengajuan',
                html: `
            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-status">Status</label>
                <select id="swal-status" class="swal2-select swal2-input">
                    <option value="menunggu" ${currentStatus === 'menunggu' ? 'selected' : ''}>Menunggu</option>
                    <option value="diterima" ${currentStatus === 'diterima' ? 'selected' : ''}>Diterima</option>
                    <option value="ditolak" ${currentStatus === 'ditolak' ? 'selected' : ''}>Ditolak</option>
                </select>
            </div>

            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-guru_id">Guru Pembimbing</label>
                <select id="swal-guru_id" class="swal2-select swal2-input">
                    <option value="">-- Pilih Guru --</option>
                    ${guruOptions}
                </select>
            </div>

            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-instruktur_id">Instruktur</label>
                <select id="swal-instruktur_id" class="swal2-select swal2-input">
                    <option value="">-- Pilih Instruktur --</option>
                    ${instrukturOptions}
                </select>
            </div>

            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" id="swal-tanggal_mulai" class="swal2-input" value="">
            </div>

            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" id="swal-tanggal_selesai" class="swal2-input" value="">
            </div>

            <div class="mb-4 text-left">
                <label class="block text-sm font-medium text-gray-700 swal2-label" for="swal-alasan">Alasan (opsional)</label>
                <textarea id="swal-alasan" class="swal2-textarea" placeholder="Alasan (opsional)"></textarea>
            </div>
        `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const status = document.getElementById('swal-status').value;
                    const guru_id = document.getElementById('swal-guru_id').value;
                    const instruktur_id = document.getElementById('swal-instruktur_id').value;
                    const tanggal_mulai = document.getElementById('swal-tanggal_mulai').value;
                    const tanggal_selesai = document.getElementById('swal-tanggal_selesai').value;
                    const alasan = document.getElementById('swal-alasan').value;

                    return {
                        status: status,
                        guru_id: guru_id,
                        instruktur_id: instruktur_id,
                        tanggal_mulai: tanggal_mulai,
                        tanggal_selesai: tanggal_selesai,
                        alasan: alasan
                    };
                }
            });

            if (formValues) {
                // Send AJAX request to update status
                const url = `/permohonan-penempatan/update-pengajuan/${id}`;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(formValues)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        Toastify({
                            text: result.message || 'Status pengajuan berhasil diperbarui!',
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#4CAF50",
                            stopOnFocus: true,
                        }).showToast();
                        location.reload();
                    } else {
                        Toastify({
                            text: result.message || 'Gagal memperbarui status pengajuan.',
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f87171",
                            stopOnFocus: true,
                        }).showToast();
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Toastify({
                        text: 'Terjadi kesalahan saat mengirim permintaan.',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f87171",
                        stopOnFocus: true,
                    }).showToast();
                }
            }
        }
    </script>
@endpush
