@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Edit Data item & Akun</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('instruktur.update', $item->id) }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ======= DATA AKUN (USER) ======= -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">Username</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="username" name="username" placeholder="Masukkan username guru" type="text"
                            value="{{ old('username', $item->user->username) }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="password">Password (opsional)</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="password" name="password" placeholder="Kosongkan jika tidak diubah" type="password">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">Konfirmasi
                            Password</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="password_confirmation" name="password_confirmation" placeholder="Ulangi password"
                            type="password">
                    </div>

                    <!-- ======= DATA item ======= -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="nama">Nama item</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nama" name="nama" placeholder="Masukkan nama lengkap" type="text"
                            value="{{ old('nama', $item->nama) }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="no_hp">No HP</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="no_hp" name="no_hp" placeholder="Masukkan nomor HP" type="text"
                            value="{{ old('no_hp', $item->no_hp) }}">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="alamat">Alamat</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" rows="3">{{ old('alamat', $item->alamat) }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="!bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                        type="submit">
                        Perbarui
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
