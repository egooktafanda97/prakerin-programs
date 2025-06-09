@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Edit Form Data Perusahaan</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('perusahaan.update', $item->id) }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="nama_perusahaan">Nama Perusahaan</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nama_perusahaan" name="nama_perusahaan" type="text"
                            value="{{ old('nama_perusahaan', $item->nama_perusahaan) }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="alamat">Alamat</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="alamat" name="alamat" type="text" value="{{ old('alamat', $item->alamat) }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="no_hp">No Telp</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="no_hp" name="no_hp" type="text" value="{{ old('no_hp', $item->no_hp) }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="bidang_usaha">Bidang</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="bidang_usaha">
                            <option>Pilih Bidang</option>
                            @foreach (\App\Constanta\Perusahaan::bidang() as $itemBidang)
                                <option {{ old('bidang_usaha', $item->bidang_usaha) == $itemBidang ? 'selected' : '' }}
                                    value="{{ $itemBidang }}">{{ $itemBidang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="koordinat">Koordinat</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="koordinat" name="koordinat" type="text" value="{{ old('koordinat', $item->koordinat) }}">
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
