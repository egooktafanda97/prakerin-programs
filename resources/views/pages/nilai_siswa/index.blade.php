@extends('layouts.admin-app')
@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Data Nilai Siswa</h4>
                <a class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                    href="{{ route('nilai-siswa.create') }}">Tambah Nilai</a>
            </div>
        </div>
        <div class="card-body">
            <div id="GridWrapper"></div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function getData() {
            try {
                return JSON.parse('{!! $data !!}');
            } catch (error) {
                return [];
            }
        }

        new gridjs.Grid({
            search: true,
            pagination: {
                limit: 10,
                summary: true
            },
            sort: true,
            resizable: true,
            columns: [{
                    name: "No"
                },
                {
                    name: "Nama Dokumen"
                },
                {
                    name: "File"
                },
                {
                    name: "Keterangan"
                },
                {
                    name: "Waktu Upload"
                },
                {
                    name: "Aksi"
                }
            ],
            data: getData().map((item, index) => [
                index + 1,
                item.nama_dokumen,
                gridjs.html(
                    `<a href="${item.dokument}" target="_blank" class="text-blue-500 underline">Lihat File</a>`
                ),
                item.keterangan ?? '-',
                new Date(item.created_at).toLocaleString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }),
                gridjs.html(`
                    <div class="flex gap-2">
                        <a href="/nilai-siswa/${item.id}" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-blue-500 border-blue-500 hover:text-white hover:bg-blue-600 hover:border-blue-600 focus:ring focus:ring-blue-100">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="/nilai-siswa/${item.id}/edit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:ring focus:ring-green-100">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="/nilai-siswa/destroy/${item.id}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:ring focus:ring-red-100">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                `)
            ])
        }).render(document.getElementById("GridWrapper"));
    </script>
@endpush
