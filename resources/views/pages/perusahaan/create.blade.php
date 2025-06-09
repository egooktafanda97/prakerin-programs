@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Form Data Perusahaan</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('perusahaan.store') }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">Nama Perusahaan</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nama_perusahaan" name="nama_perusahaan" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">Alamat</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="alamat" name="alamat" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">No Telp</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="no_hp" name="no_hp" type="text">
                    </div>


                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">Bidang</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="bidang_usaha">
                            <option>Pilih Bidang</option>
                            @foreach (\App\Constanta\Perusahaan::bidang() as $item)
                                <option>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="koordinat">Koordinat</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="koordinat" name="koordinat" type="text">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="!bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                        type="submit">
                        Simpan
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
                        backgroundColor: "#f87171", // warna merah (error)
                        stopOnFocus: true,
                    }).showToast();
                @endforeach
            });
        </script>
    @endif
@endpush
