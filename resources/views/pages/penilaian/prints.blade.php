<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Penilaian</title>
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
            <h1 style="margin: 0px;">Laporan Penilaian</h1>
            {{-- <h4 style="margin: 0px;">..</h4> --}}

        </div>
    </div>
    <hr>
    {{-- @dd($penempatanPrakerin); --}}
    <table id="datatablesSimple">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-1 px-3 text-left">No</th>
                <th class="py-1 px-3 text-left">Nama Siswa</th>
                <th class="py-1 px-3 text-left">Kelas</th>
                <th class="py-1 px-3 text-left">Tahun Ajaran</th>
                <th class="py-1 px-3 text-left">Penempatan</th>
                <th class="py-1 px-3 text-left">Instruktur</th>
                <th class="py-1 px-3 text-left">Nilai Kehadiran</th>
                <th class="py-1 px-3 text-left">Nilai Kedisiplinan</th>
                <th class="py-1 px-3 text-left">Nilai Kerjasama</th>
                <th class="py-1 px-3 text-left">Nilai Inisiatif</th>
                <th class="py-1 px-3 text-left">Nilai Akhir</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
            @foreach ($siswa as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-1 px-3 text-left">{{ $loop->iteration }}</td>
                    <td class="py-1 px-3 text-left">{{ $item->nama }}</td>
                    <td class="py-1 px-3 text-left">
                        {{ $item->kelas ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item->penempatanPrakerin->tahun_ajaran ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item->penempatanPrakerin->perusahaan->nama_perusahaan ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item->penempatanPrakerin->instruktur->nama ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item?->penilaian?->nilai_kehadiran ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item?->penilaian?->nilai_disiplin ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item?->penilaian?->nilai_kerjasama ?? '-' }}
                    </td>
                    <td class="py-1 px-3 text-left">
                        {{ $item?->penilaian?->nilai_inisiatif ?? '-' }}
                    </td>

                    <td class="py-1 px-3 text-left">
                        {{ $item?->penilaian?->nilai_akhir ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 100px; padding: 20px">
        {{-- ttd --}}
        <div style="display: flex; justify-content: flex-end; margin-right: 10px">

            <div style="margin-right: 10px">
                <p>Guru</p>
                <br><br><br>
                __________________
                <p><strong>....</strong></p>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
