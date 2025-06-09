<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan log book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            position: relative;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
            top: 0;
            position: absolute;
            /* Adjust the width as needed */
            /* height: auto; */
            margin-right: 20px;
        }

        .kop-teks {
            text-align: center;
            flex: 1;
        }

        .kop-teks h1,
        .kop-teks h2 {
            margin: 0;
        }

        hr {
            border: 1px solid black;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            font-size: .8em;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            background-color: #f2f2f2;
        }

        .image-grid {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly !important;
            justify-items: center;
            /* Untuk mengompensasi margin pada gambar */
        }

        .image-grid img {
            margin-top: 10px;
            height: 150px;
            padding-top: 10px;
            width: 19%;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="kop-teks">
            <h1 style="margin: 0px;">Laporan Log Book</h1>
            {{-- <h4 style="margin: 0px;">..</h4> --}}

        </div>
    </div>
    <hr>
    {{-- @dd($penempatanPrakerin); --}}
    <p>Nama Siswa: {{ $penempatanPrakerin->siswa->nama }}</p>
    <p>Perusahaan: {{ $penempatanPrakerin->perusahaan->nama_perusahaan }}</p>
    <table id="datatablesSimple">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">No</th>
                <th class="py-3 px-6 text-left">Tanggal</th>
                <th class="py-3 px-6 text-left">Kegiatan</th>
                <th class="py-3 px-6 text-left">Validasi Instruktur</th>
                <th class="py-3 px-6 text-left">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6 text-left">{{ $item->tanggal }}</td>
                    <td class="py-3 px-6 text-left">{{ $item->aktivitas }}</td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            @if ($item->validasi_instruktur == 'Valid')
                                <span class="text-green-500">Valid</span>
                            @elseif ($item->validasi_instruktur == 'Tidak Valid')
                                <span class="text-red-500">Tidak Valid</span>
                            @else
                                <span class="text-red-500">Belum Diverifikasi</span>
                            @endif
                            @if (auth()->user()->role == 'instruktur' && $item->validasi_instruktur == 'Belum Diverifikasi')
                                <form action="{{ route('logbook-prakerin.validasi', $item->id) }}" class="ml-2"
                                    method="POST">
                                    @csrf
                                    <button
                                        class="text-white btn bg-blue-500 border-blue-500 hover:text-white hover:bg-blue-600 hover:border-blue-600 focus:text-white focus:bg-blue-600 focus:border-blue-600 focus:ring focus:ring-blue-100 active:text-white active:bg-blue-600 active:border-blue-600 active:ring active:ring-blue-100 dark:ring-blue-400/20"
                                        type="submit">
                                        Validasi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 100px; padding: 20px">
        {{-- ttd --}}
        <div style="display: flex; justify-content: space-between; margin-right: 10px">
            <div style="margin-right: 10px">
                <p>Siswa</p>
                <br><br><br>
                __________________
                <p><strong>{{ $penempatanPrakerin->siswa->nama }}</strong></p>
            </div>
            <div style="margin-right: 10px">
                <p>Guru</p>
                <br><br><br>
                __________________
                <p><strong>{{ $penempatanPrakerin->guru->nama }}</strong></p>
            </div>
            <div style="margin-right: 10px">
                <p>Instruktur</p>
                <br><br><br>
                __________________
                <p><strong>{{ $penempatanPrakerin->instruktur->nama }}</strong></p>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
