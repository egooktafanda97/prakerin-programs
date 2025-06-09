@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Form Data Guru & Akun</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('guru.store') }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ======= DATA AKUN (USER) ======= -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="username">Username</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="username" name="username" placeholder="Masukkan username guru" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="password">Password</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="password" name="password" placeholder="Masukkan password akun" type="password">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">Konfirmasi
                            Password</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="password_confirmation" name="password_confirmation" placeholder="Ulangi password"
                            type="password">
                    </div>

                    <!-- ======= DATA GURU ======= -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="nip">NIP</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nip" name="nip" placeholder="Masukkan NIP guru" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="nama">Nama Lengkap</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nama" name="nama" placeholder="Contoh: Budi" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="mata_pelajaran">Mata Pelajaran</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="mata_pelajaran" name="mata_pelajaran" placeholder="Contoh: Matematika" type="text">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="no_hp">No. HP</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="no_hp" name="no_hp" placeholder="Contoh: 08123456789" type="text">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="alamat">Alamat</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="alamat" name="alamat" placeholder="Masukkan alamat lengkap guru" rows="3"></textarea>
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
