 @extends('layouts.admin-app')
 @section('content')
     <style>
         #map {
             width: 100%;
             height: 500px;
         }
     </style>
     <div class="card mt-5">
         <div class="card-header mb-0 pl-5 pr-5 pt-5 pb-0">
             <div class="flex justify-between">
                 <h4 class="card-title">Dashboard</h4>
             </div>
         </div>
         <div class="card-body">

             <div class="grid grid-cols-12 gap-4">
                 <!-- Row 1 -->
                 <div class="col-span-4  p-4 ">
                     <div class="bg-white overflow-hidden shadow rounded-lg border">
                         <div class="px-4 py-5 sm:px-6">
                             <h3 class="text-lg leading-6 font-medium text-gray-900">
                                 Detail Instruktur
                             </h3>
                             <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                 Informasi lengkap mengenai instruktur.
                             </p>
                         </div>
                         <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                             <dl class="sm:divide-y sm:divide-gray-200">

                                 {{-- Data Nama --}}
                                 <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                     <dt class="text-sm font-medium text-gray-500">
                                         Nama Lengkap
                                     </dt>
                                     <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                         {{ $item->nama }}
                                     </dd>
                                 </div>

                                 {{-- Data Nomor HP --}}
                                 <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                     <dt class="text-sm font-medium text-gray-500">
                                         Nomor Telepon
                                     </dt>
                                     <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                         {{ $item->no_hp }}
                                     </dd>
                                 </div>

                                 {{-- Data Alamat --}}
                                 <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                     <dt class="text-sm font-medium text-gray-500">
                                         Alamat
                                     </dt>
                                     <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                         {{ $item->alamat }}
                                     </dd>
                                 </div>

                                 {{-- Data Created At --}}
                                 <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                     <dt class="text-sm font-medium text-gray-500">
                                         Dibuat Pada
                                     </dt>
                                     <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                         {{ $item->created_at->format('d M Y, H:i') }}
                                     </dd>
                                 </div>

                                 {{-- Data Updated At --}}
                                 <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                     <dt class="text-sm font-medium text-gray-500">
                                         Terakhir Diperbarui
                                     </dt>
                                     <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                         {{ $item->updated_at->format('d M Y, H:i') }}
                                     </dd>
                                 </div>

                                 {{-- Contoh bagaimana jika ada relasi user_id ke tabel users --}}
                                 @if ($item->user)
                                     <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                         <dt class="text-sm font-medium text-gray-500">
                                             Dibuat Oleh (User ID)
                                         </dt>
                                         <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                             {{ $item->user->name ?? 'N/A' }} (ID: {{ $item->user_id }})
                                         </dd>
                                     </div>
                                 @endif

                             </dl>
                         </div>
                     </div>
                 </div>
                 <div class="col-span-8 p-4 ">
                     <div id="map"></div>
                 </div>
             </div>


         </div>
     </div>
 @endsection
 @push('script')
     {{-- Google Maps API --}}
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRQDtcZ55EQ_2hVJFwAb1Vd9kEPyJGmY"
         type="text/javascript"></script>
     <script>
         function getData() {
             try {
                 const rawData = {!! $data !!}; // Sudah dalam bentuk array JS dari controller
                 return rawData.map(item => {
                     const [latStr, lngStr] = item.koordinat.split(',');
                     return {
                         position: {
                             lat: parseFloat(latStr),
                             lng: parseFloat(lngStr)
                         },
                         title: item.nama_perusahaan,
                         info: `${item.nama_perusahaan}<br>${item.alamat}<br>${item.no_hp}<br>Bidang: ${item.bidang_usaha}`
                     };
                 });
             } catch (error) {
                 console.error("Error parsing data:", error);
                 return [];
             }
         }

         let map; // Variabel global untuk objek peta

         // Fungsi untuk menginisialisasi peta
         function initMap() {
             console.log("initMap() dipanggil. Mencoba menginisialisasi peta...");

             // Pastikan elemen #map ada sebelum mencoba membuat peta
             const mapElement = document.getElementById('map');
             if (!mapElement) {
                 console.error("Elemen dengan ID 'map' tidak ditemukan di DOM.");
                 return; // Hentikan eksekusi jika elemen tidak ada
             }

             // Koordinat pusat peta (contoh: Jakarta),
             const centerLocation = {
                 lat: 0.2971720522360002,
                 lng: 102.27441055239692
             };

             // Opsi peta
             const mapOptions = {
                 zoom: 12, // Level zoom awal
                 center: centerLocation, // Pusat peta
                 mapTypeId: 'roadmap', // Tipe peta (roadmap, satellite, hybrid, terrain)
                 fullscreenControl: true, // Kontrol fullscreen
                 zoomControl: true, // Kontrol zoom
                 streetViewControl: false, // Kontrol Street View
                 mapTypeControl: false, // Kontrol tipe peta
             };

             try {
                 // Membuat objek peta baru dan menempatkannya di div dengan id 'map'
                 map = new google.maps.Map(mapElement, mapOptions);
                 console.log("Peta berhasil diinisialisasi.");
                 console.log("Koordinat pusat peta:", getData());

                 // Daftar marker yang akan ditambahkan
                 const markersData = getData();

                 // Menambahkan marker ke peta
                 markersData.forEach(markerInfo => {
                     const marker = new google.maps.Marker({
                         position: markerInfo.position,
                         map: map,
                         title: markerInfo.title,
                         animation: google.maps.Animation.DROP // Efek animasi saat marker muncul
                     });

                     // Membuat jendela informasi (InfoWindow) untuk setiap marker
                     const infoWindow = new google.maps.InfoWindow({
                         content: `<strong>${markerInfo.title}</strong><br>${markerInfo.info}`
                     });

                     // Menambahkan event listener agar InfoWindow muncul saat marker diklik
                     marker.addListener('click', () => {
                         infoWindow.open(map, marker);
                     });
                 });
                 console.log(`${markersData.length} marker ditambahkan ke peta.`);

                 // Menyesuaikan ukuran peta saat ukuran jendela berubah
                 google.maps.event.addDomListener(window, 'resize', () => {
                     const center = map.getCenter();
                     google.maps.event.trigger(map, 'resize');
                     map.setCenter(center);
                 });

             } catch (error) {
                 console.error("Gagal menginisialisasi peta Google Maps:", error);
                 console.error(
                     "Pastikan Anda memiliki koneksi internet, API Key yang valid, dan Maps JavaScript API diaktifkan di Google Cloud Console."
                 );
             }
         }

         // Memuat Google Maps API secara asinkron
         // GANTI 'YOUR_GOOGLE_MAPS_API_KEY' dengan API Key Anda yang sebenarnya
         // Pastikan Maps JavaScript API sudah diaktifkan di Google Cloud Console Anda
         const script = document.createElement('script');
         // Gunakan API Key yang Anda berikan. Periksa kembali validitas dan pembatasannya.
         script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyCXRQDtcZ55EQ_2hVJFwAb1Vd9kEPyJGmY&callback=initMap`;
         script.async = true;
         script.defer = true;
         document.head.appendChild(script);

         // Tambahkan event listener untuk memastikan script dimuat
         script.onload = () => {
             console.log("Google Maps API script berhasil dimuat.");
         };
         script.onerror = (e) => {
             console.error("Gagal memuat Google Maps API script:", e);
             console.error("Pastikan URL API Key benar dan tidak ada masalah jaringan/CSP.");
         };
     </script>
 @endpush
