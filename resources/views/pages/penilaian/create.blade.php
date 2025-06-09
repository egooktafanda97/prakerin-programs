@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Form Data Penilaian {{ $siswa->nama }}</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('penilaian.store') }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="siswa_id" type="hidden" value="{{ request()->id }}">

                    <!-- Nilai Kehadiran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nilai_kehadiran">Nilai Kehadiran</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nilai_kehadiran" max="100" min="0" name="nilai_kehadiran" type="number" />
                    </div>

                    <!-- Nilai Disiplin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nilai_disiplin">Nilai Disiplin</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nilai_disiplin" max="100" min="0" name="nilai_disiplin" type="number" />
                    </div>

                    <!-- Nilai Kerjasama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nilai_kerjasama">Nilai Kerjasama</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nilai_kerjasama" max="100" min="0" name="nilai_kerjasama" type="number" />
                    </div>

                    <!-- Nilai Inisiatif -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nilai_inisiatif">Nilai Inisiatif</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="nilai_inisiatif" max="100" min="0" name="nilai_inisiatif" type="number" />
                    </div>



                    <!-- Catatan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700" for="catatan">Catatan</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="catatan" name="catatan" rows="3"></textarea>
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
                        backgroundColor: "#f87171",
                        stopOnFocus: true,
                    }).showToast();
                @endforeach
            });
        </script>
    @endif
@endpush
