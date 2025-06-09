@extends('layouts.admin-app')

@section('content')
    <div class="card mt-5">
        <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
            <div class="flex justify-between">
                <h4 class="card-title">Form Logbook Prakerin</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('logbook-prakerin.update', $item->id) }}" class="px-5 pt-5 pb-2" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="tanggal">Tanggal</label>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="tanggal" name="tanggal" required type="date"
                            value="{{ old('tanggal', $item->tanggal) }}" />
                    </div>

                    {{-- Aktivitas --}}
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="aktivitas">Aktivitas</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="aktivitas" name="aktivitas" placeholder="Deskripsikan aktivitas prakerin hari ini..." required rows="4">{{ old('aktivitas', $item->aktivitas) }}</textarea>
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
