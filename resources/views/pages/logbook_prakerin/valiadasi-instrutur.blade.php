@extends('layouts.admin-app')
@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Log Aktifitas</h4>
                <a class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                    href="{{ route('logbook-prakerin.create') }}">Tambah Aktifitas</a>
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
                limit: 5,
                summary: true
            },
            sort: true,
            resizable: true,
            columns: [{
                    name: "No",
                },
                {
                    name: "Kegiatan",
                },
                {
                    name: "Tanggal",
                },
                {
                    name: "Validasi Instruktur",
                },
                {
                    name: "Created At",
                    sort: {
                        compare: (a, b) => new Date(a) - new Date(b)
                    }
                },
                {
                    name: "Action",
                }
            ],
            data: getData()
                .map((item) => [
                    item.no,
                    item.aktivitas,
                    item.tanggal,
                    gridjs.html(`
                        <input type="checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" data-id="${item.id}" ${item.validasi_instruktur ? 'checked' : ''} />
                    `),
                    item.created_at,
                    gridjs.html(
                        `<div class="flex gap-2">
                <a href="/logbook-prakerin/${item.id}/edit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="/logbook-prakerin/${item.id}" method="POST" class="inline">
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
@push('style')
    <link href="{{ asset('checkbox.css') }}" rel="stylesheet">
@endpush
@push('script')
    <script src="{{ asset('checkbox.js') }}"></script>
@endpush
