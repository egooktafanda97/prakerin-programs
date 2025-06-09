@extends('layouts.admin-app')
@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Penempatan Prakerin</h4>
                <a class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                    href="{{ route('penempatan.create') }}">Tambah Penempatan</a>
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
        console.log(getData());

        new gridjs.Grid({
            search: true,
            pagination: {
                limit: 5,
                summary: true
            },
            sort: true,
            resizable: true,
            columns: [{
                    name: "Tahun Ajaran",

                },
                {
                    name: "Nama Siswa",
                },
                {
                    name: "Nama Perusahaan",
                },
                {
                    name: "Nama Guru",
                },
                {
                    name: "Nama Instruktur",
                },
                {
                    name: "Tanggal Mulai",
                },
                {
                    name: "Tanggal Selesai",
                },
                {
                    name: "Action",
                }
            ],
            data: getData()
                .map((item) => [
                    item.tahun_ajaran,
                    item.siswa.nama,
                    item.perusahaan.nama_perusahaan,
                    item.guru.nama,
                    item.instruktur.nama,
                    item.tanggal_mulai,
                    item.tanggal_selesai,
                    gridjs.html(
                        `<div class="flex gap-2">
                            <a href="/penempatan/${item.id}/edit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">
                                <i class="fa fa-edit"></i>
                                </a>
                            <form action="/penempatan/${item.id}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                    <i class="fa fa-trash"></i>
                                    </button>
                            </form>
                        </div>`
                    )
                ]),
        }).render(document.getElementById("GridWrapper"));
    </script>
@endpush
