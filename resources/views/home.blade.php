<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BZJHVHE7EZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-BZJHVHE7EZ');
    </script>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#274043">

    <title>@yield('title', 'TSN')</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body class="font-raleway antialiased bg-tsn-bg no-scrollbar">
    {{-- header --}}
    <div class="flex sticky top-0 h-24 z-50 bg-tsn-header border-b-4 border-tsn-accent justify-between">
        <div class="w-fit px-2 mt-4 me-4">
            <a href="https://tsn.ponpes.id/">
                <figure><img src="\LogoTSN.png" alt="Album" class="w-16" /></figure>
            </a>
        </div>
        <div class="w-fit"></div>
        <div class="w-fit mt-4 me-4">
            {{-- <figure><img src="\LogoTSN.png" alt="Album" class="w-16" /></figure> --}}
        </div>
    </div>


    <div class="flex w-full pt-8 justify-center flex-col">

        <div>
            <p class="lg:text-5xl sm:text-3xl text-tsn-header font-raleway text-center text-bold"><strong>MA'HAD
                    TA'DZIMUSSUNNAH</strong>
            </p>
        </div>
        <div>
            <p class="lg:text-3xl sm:text-2xl text-tsn-header font-raleway text-center"><strong>SINE NGAWI</strong>
            </p>
            </br>
        </div>
        <div>
            <a href="https://emis.kemenag.go.id/pontren/pencarian">
                <p class="lg:text-lg sm:text-lg text-tsn-header font-raleway text-center"><strong>Nomor Statistik
                        Pesantren: </br><u>510035210133</u></strong>
                </p>
            </a>
        </div>
    </div>





    {{-- Start Rincian Program --}}
    <div class="grid sm:grid-cols-1 lg:grid-cols-2 w-full h-fit justify-items-center p-4">

        {{-- TA --}}
        <div class="px-3 py-3 w-fit justify-center justify-self-center">
            <div class="card lg:card-side bg-base-100 shadow-xl px-4 py-4">
                <figure><img src="logoqism\Tarbiyatul Aulaad.png" alt="Album" class="w-32" /></figure>
                <div class="card-body">
                    <h2 class="card-title self-center text-center text-tsn-header">Qism Tarbiyatul Aulaad</h2>
                    <h4 class="card-title self-center text-center text-tsn-header text-md">(Setingkat TK)</h4>
                    <br>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="border-tsn-header">
                                <th class="text-tsn-header" colspan="2">Informasi hubungi:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th><a href="https://wa.me/6285233745522">@svg('heroicon-o-phone', 'w-4 h-4',
                                        ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285233745522">Ustadz Abu Tsabit
                                        (Putra)</a></td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th><a href="https://wa.me/6282328485257">@svg('heroicon-o-phone', 'w-4 h-4',
                                        ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6282328485257">Kontak person
                                        putri</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="card-actions justify-start">
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="rincian_program_ta.showModal()">Rincian
                            Program</button>
                        <dialog id="rincian_program_ta" class="modal">
                            <div class="modal-box">

                                <br>

                                {{-- Tabel Rincian Program TA --}}
                                <div class="bg-tsn-header w-full border-b-4 border-tsn-accent">

                                    <h3 class="font-bold text-lg text-white text-center">Rincian Program Qism
                                        Tarbiyatul
                                        Aulaad</h3>

                                    <br>
                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">TARGET PENDIDIKAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Memahamkan dan membiasakan anak didik untuk mempelajari serta
                                                    mengamalkan ilmu agama sejak kecil</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Menanamkan pada diri anak didik kecintaan dan rasa butuh
                                                    terhadap
                                                    ilmu agama</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Anak didik mampu membaca Al Qur’an dan aksara latin dengan baik
                                                </td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Anak didik mampu menulis arab dan latin dengan baik</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Anak didik mampu menerapkan ilmu yang dipelajari dalam kehidupan
                                                    sehari-hari</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Anak didik memiliki hafalan Al Qur’an ( Juz Amma ) dan doa
                                                    sehari-hari
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">MATERI PENDIDIKAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Aqidah</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Akhlak</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Fiqh</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Tarikh/Sejarah Islam</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Baca tulis arab</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Baca tulis latin</td>
                                            </tr>
                                            <!-- row 7 -->
                                            <tr>
                                                <th>7</th>
                                                <td>Berhitung</td>
                                            </tr>
                                            <!-- row 8 -->
                                            <tr>
                                                <th>8</th>
                                                <td>Seni</td>
                                            </tr>
                                            <!-- row 8 -->
                                            <tr>
                                                <th></th>
                                                <td>Dll</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SYARAT PENDAFTARAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Putra/putri berusia minimal 4,5 tahun</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Sehat jasmani dan Rohani</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Fotokopi akte kelahiran</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Fotokopi Kartu Keluarga</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Mengisi formular pendaftaran</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Orang tua/wali sanggup mengikuti peraturan yang berlaku</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">DOKUMEN-DOKUMEN
                                                    PERSYARATAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Kartu Keluarga</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>Akte Kelahiran</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>Surat Rekomendasi dari sekolah sebelumnya</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <td>Ijazah atau Laporan Hasil Evaluasi Belajar dari sekolah
                                                    sebelumnya
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>5</th>
                                                <td>Surat Keterangan Ta'lim untuk walisantri</td>
                                            </tr>
                                            <tr>
                                                <th>6</th>
                                                <td>Surat Kuasa dari Orangtua Kandung (Jika yang mendaftarkan adalah
                                                    wali)</td>
                                            </tr>
                                            <tr>
                                                <th>7</th>
                                                <td>Sertifikat Vaksin Covid-19 (vaksin terakhir)</td>
                                            </tr>
                                            <tr>
                                                <th>8</th>
                                                <td>Surat pernyataan kesanggupan bermaterai (Format Surat dapat
                                                    diunduh
                                                    dari formulir)</td>
                                            </tr>
                                            <tr>
                                                <th>9</th>
                                                <td>Surat Permohonan Keringanan Administrasi (bagi yang mengajukan
                                                    keringanan)</td>
                                            </tr>
                                            <tr>
                                                <th>10</th>
                                                <td>Surat Keterangan tidak mampu dari Ustadz setempat (bagi yang
                                                    mengajukan keringanan)</td>
                                            </tr>
                                            <tr>
                                                <th>11</th>
                                                <td>Surat Keterangan tidak mampu dari aparat pemerintah setempat
                                                    (bagi
                                                    yang mengajukan keringanan)</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <br>

                                <div>
                                    <table>
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-b">
                                                <th class="text-lg text-tsn-header" colspan="4">RINCIAN BIAYA AWAL
                                                    DAN
                                                    SPP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">50.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">150.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP* </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">75.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>375.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal
                                                    termasuk
                                                    SPP bulan pertama</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <br>
                                <div class="flex sticky bottom-0 bg-transparent w-full justify-between rounded-xl">
                                    {{-- <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                                        onclick="daftar_pt.showModal()">Daftar</button>
                                    <dialog id="daftar_pt" class="modal">
                                        <div class="modal-box">
                                            <div class="sticky top-0 right-0">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                                </form>
                                            </div>
                                            <div>
                                                <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                            </div>
                                        </div>
                                    </dialog> --}}
                                    <form method="dialog">
                                        <button class="btn bg-tsn-accent focus:bg-tsn-bg">Tutup</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        {{-- <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="daftar_ta.showModal()">Daftar</button>
                        <dialog id="daftar_ta" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                    </form>
                                </div>
                                <div>
                                    <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                </div>
                            </div>
                        </dialog> --}}
                    </div>
                </div>

            </div>
        </div>

        {{-- PT --}}
        <div class="px-3 py-3 w-fit justify-center justify-self-center">
            <div class="card lg:card-side bg-base-100 shadow-xl px-4 py-4">
                <figure><img src="logoqism\Pra tahfidz.png" alt="Album" class="w-32" /></figure>
                <div class="card-body">
                    <h2 class="card-title self-center text-center text-tsn-header">Qism Pra Tahfidz</h2>
                    <h4 class="card-title self-center text-center text-tsn-header text-md">(Setingkat SD)</h4>
                    <br>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="border-tsn-header">
                                <th class="text-tsn-header" colspan="2">Informasi hubungi:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th><a href="https://wa.me/6285235636182">@svg('heroicon-o-phone', 'w-4 h-4',
                                        ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285235636182">Ustadz Abu
                                        Ruwaifi'
                                        (Putra)</a></td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th><a href="https://wa.me/6285234772629">@svg('heroicon-o-phone', 'w-4 h-4',
                                        ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285234772629">Kontak person
                                        putri</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="card-actions justify-start">
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="rincian_program_pt.showModal()">Rincian
                            Program</button>
                        <dialog id="rincian_program_pt" class="modal">
                            <div class="modal-box">

                                <br>
                                <div class="bg-tsn-header w-full border-b-4 border-tsn-accent">

                                    <h3 class="font-bold text-lg text-white text-center">Rincian Program Qism Pra
                                        Tahfidz</h3>

                                    <br>
                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">TUJUAN PENDIDIKAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Memahamkan dan membiasakan anak didik untuk mempelajari dan
                                                    mengamalkan ilmu agama sejak dini</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Membekali dengan pendidikan dasar yang disesuaikan dengan
                                                    kebutuhan
                                                    agar anak tidak tertinggal jauh dalam hal akademis dengan
                                                    anak-anak
                                                    seusianya yang mengeyam pendidikan dasar umum</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Menanamkan kecintaan dan rasa butuh terhadap ilmu
                                                </td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Menanamkan kesadaran untuk belajar</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Melatih kemandirian belajar di ma’had secara bertahap</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">MATERI PELAJARAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">1</th>
                                                <td class="text-tsn-header"><strong>MATERI POKOK DINIYAH</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Aqidah</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Akhlak dan adab</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Hafalan Qur’an</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Fiqh</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Siroh</td>
                                            </tr>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">2</th>
                                                <td class="text-tsn-header"><strong>MATERI ALAT</strong></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Qiroah</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Bahasa arab</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Khot</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Jarlis</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Tajwid</td>
                                            </tr>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">3</th>
                                                <td class="text-tsn-header"><strong>MATERI PENGETAHUAN UMUM
                                                        DASAR</strong></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Matematika</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>IPS</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Bahasa Indonesia</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Kesehatan dasar</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>IPA</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SISTEM PENDIDIKAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Membagi anak dalam kelompok kelas berdasarkan kemampuan dasar
                                                    dan
                                                    umurnya</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Evaluasi belajar diberikan tiap semester dalam bentuk rapor</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Adanya program full day bagi anak kelas 1 s.d 4, sehingga
                                                    diharapkan
                                                    anak istirahat / tidur siang di ma’had, dengan membawa bekal
                                                    makan
                                                    siang dari rumah</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Adanya program menginap terkhusus anak kelas 5 dan 6, yang
                                                    dibedakan
                                                    sesuai dengan tingkat kesiapan anak pada tiap tingkatan kelasnya
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SYARAT PENDAFTARAN
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Putra usia 6 s/d 12 tahun</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>Sehat jasmani dan rohani</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>Dapat membaca dan menulis latin dan arab</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <td>Orang tua / wali sanggup mematuhi peraturan yang berlaku di
                                                    ma’had
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>5</th>
                                                <td>Membawa perlengkapan menginap</td>
                                            </tr>
                                            <tr>
                                                <th>6</th>
                                                <td>Mengisi formulir pendaftaran</td>
                                            </tr>
                                            <tr>
                                                <th>7</th>
                                                <td>Memenuhi dokumen-dokumen pendaftaran</td>
                                            </tr>
                                            <tr>
                                                <th>8</th>
                                                <td>Bagi santri pindahan diwajibkan membawa surat keterangan baik
                                                    dari
                                                    ma’had sebelumnya</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">DOKUMEN-DOKUMEN
                                                    PERSYARATAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Kartu Keluarga</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>Akte Kelahiran</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>Surat Rekomendasi dari sekolah sebelumnya</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <td>Ijazah atau Laporan Hasil Evaluasi Belajar dari sekolah
                                                    sebelumnya
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>5</th>
                                                <td>Surat Keterangan Ta'lim untuk walisantri</td>
                                            </tr>
                                            <tr>
                                                <th>6</th>
                                                <td>Surat Kuasa dari Orangtua Kandung (Jika yang mendaftarkan adalah
                                                    wali)</td>
                                            </tr>
                                            <tr>
                                                <th>7</th>
                                                <td>Sertifikat Vaksin Covid-19 (vaksin terakhir)</td>
                                            </tr>
                                            <tr>
                                                <th>8</th>
                                                <td>Surat pernyataan kesanggupan bermaterai (Format Surat dapat
                                                    diunduh
                                                    dari formulir)</td>
                                            </tr>
                                            <tr>
                                                <th>9</th>
                                                <td>Surat Permohonan Keringanan Administrasi (bagi yang mengajukan
                                                    keringanan)</td>
                                            </tr>
                                            <tr>
                                                <th>10</th>
                                                <td>Surat Keterangan tidak mampu dari Ustadz setempat (bagi yang
                                                    mengajukan keringanan)</td>
                                            </tr>
                                            <tr>
                                                <th>11</th>
                                                <td>Surat Keterangan tidak mampu dari aparat pemerintah setempat
                                                    (bagi
                                                    yang mengajukan keringanan)</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <br>

                                <div>
                                    <table>
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-b">
                                                <th class="text-lg text-tsn-header" colspan="4">RINCIAN BIAYA AWAL
                                                    DAN
                                                    SPP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP* </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">550.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>1.150.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal
                                                    termasuk
                                                    SPP bulan pertama</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table>
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-b">
                                                <th class="text-lg text-tsn-header" colspan="4">RINCIAN BIAYA AWAL
                                                    DAN
                                                    SPP (fullday tanpa makan)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP* </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>800.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal
                                                    termasuk
                                                    SPP bulan pertama</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table>
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-b">
                                                <th class="text-lg text-tsn-header" colspan="4">RINCIAN BIAYA AWAL
                                                    DAN
                                                    SPP (fullday dengan makan)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP* </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>900.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal
                                                    termasuk
                                                    SPP bulan pertama</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div class="flex sticky bottom-0 bg-transparent w-full justify-between rounded-xl">
                                    {{-- <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                                        onclick="daftar_pt.showModal()">Daftar</button>
                                    <dialog id="daftar_pt" class="modal">
                                        <div class="modal-box">
                                            <div class="sticky top-0 right-0">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                                </form>
                                            </div>
                                            <div>
                                                <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                            </div>
                                        </div>
                                    </dialog> --}}
                                    <form method="dialog">
                                        <button class="btn bg-tsn-accent focus:bg-tsn-bg">Tutup</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        {{-- <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="daftar_pt.showModal()">Daftar</button>
                        <dialog id="daftar_pt" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                    </form>
                                </div>
                                <div>
                                    <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                </div>
                            </div>
                        </dialog> --}}
                    </div>
                </div>

            </div>
        </div>

    </div>
    {{-- End Rincian Program --}}

    <div class="px-3 py-3 w-fit justify-center justify-self-center">
        {{-- <div class="card lg:card-side bg-base-100 shadow-xl px-4 py-4"> --}}

            <div class="w-auto h-auto p-4 shadow-xl bg-base-100 rounded-xl">
                <h2 class="text-2xl text-tsn-header text-center"><strong>Gallery</strong></h2>
                <br>
                <div class="carousel rounded-xl w-full h-full shadow-xl">
                    <div id="slide1" class="carousel-item relative w-full">
                        <img src="tsngallery/Selatan menghadap utara.png" class="lg:w-100 w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Tampak dari selatan</p>
                        </div>
                    </div>
                    <div id="slide2" class="carousel-item relative w-full">
                        <img src="tsngallery/Depan menghadap selatan.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Pondok Pesantren tampak gedung baru</p>
                        </div>
                    </div>
                    <div id="slide3" class="carousel-item relative w-full">
                        <img src="tsngallery/Depan menghadap utara.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Pondok Pesantren tampak Area Masjid</p>
                        </div>
                    </div>
                    <div id="slide4" class="carousel-item relative w-full">
                        <img src="tsngallery/Masjid.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Masjid Pondok Pesantren Ta'dzimussunnah Sine Ngawi</p>
                        </div>
                    </div>
                    <div id="slide5" class="carousel-item relative w-full">
                        <img src="tsngallery/Lapangan.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Area Halaman Masjid</p>
                        </div>
                    </div>
                    <div id="slide6" class="carousel-item relative w-full">
                        <img src="tsngallery/Sakan PT.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Asrama dan Sakan PT Putra</p>
                        </div>
                    </div>
                    <div id="slide7" class="carousel-item relative w-full">
                        <img src="tsngallery/Kelas TA.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Ruang KBM TA Putra</p>
                        </div>
                    </div>
                    <div id="slide8" class="carousel-item relative w-full">
                        <img src="tsngallery/Syirkah Putra.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Syirkah/Toko Putra</p>
                        </div>
                    </div>
                    <div id="slide9" class="carousel-item relative w-full">
                        <img src="tsngallery/Masjid Putri.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Masjid Putri</p>
                        </div>
                    </div>
                    <div id="slide10" class="carousel-item relative w-full">
                        <img src="tsngallery/Aula Putri.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Aula Putri</p>
                        </div>
                    </div>
                    <div id="slide11" class="carousel-item relative w-full">
                        <img src="tsngallery/Syirkah Putri.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Syirkah Putri</p>
                        </div>
                    </div>
                    <div id="slide12" class="carousel-item relative w-full">
                        <img src="tsngallery/Kegiatan Rihlah.png" class="w-full" />
                        <div
                            class="bg-base-100 absolute flex justify-between transform left-2 -translate-y-1/2 5 bottom-0">
                            <p>Salah satu kegiatan rihlah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}

    <footer class="footer p-10 bg-tsn-header text-primary-content border-t-4 border-tsn-accent">
        <aside>
            <figure><img src="\LogoTSN.png" alt="Album" class="w-28" /></figure>
            <p class="font-raleway">
                Ma'had Ta'dzimussunnah <br />Sine Ngawi
            </p>
            <p class="font-raleway">Nomor Statistik Pesantren: 510035210133</p>
            <p class="font-raleway">Dusun Krajan RT 02/RW 02 Desa Ketanggung Kec. Sine Kab. Ngawi 63264</p>
            <p class="font-raleway text-center"><a href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">Link Google
                    Maps</a>
            </p>
            <p class="font-raleway text-center"><a
                    href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">@svg('heroicon-o-map-pin', 'w-4 h-4', ['style'
                    => 'color: #d3c281'])</a></p>
        </aside>
        <nav>
            <h6 class="footer-title">Kunjungi</h6>
            <div class="grid grid-flow-col gap-4">
                <a href="https://psb.tsn.ponpes.id/">
                    <figure><img src="\PSBTSNLogo.png" alt="PSB TSN" class="w-24" /></figure>
                </a>
                <a href="https://radio.tsn.ponpes.id/">
                    <figure><img src="\RMTSLogo.png" alt="Radio TSN" class="w-28" /></figure>
                </a>
            </div>
        </nav>
    </footer>

    {{-- <footer class="footer footer-center p-10 bg-tsn-header text-primary-content border-t-4 border-tsn-accent">
        <aside>
            <figure><img src="\LogoTSN.png" alt="Album" class="w-16" /></figure>
            <p class="font-raleway">
                Ma'had Ta'dzimussunnah <br />Sine Ngawi
            </p>
            <p class="font-raleway">Nomor Statistik Pesantren: 510035210133</p>
            <p class="font-raleway">Dusun Krajan RT 02/RW 02 Desa Ketanggung Kec. Sine Kab. Ngawi 63264</p>
            <p class="font-raleway text-center"><a href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">Link Google
                    Maps</a>
            </p>
            <p class="font-raleway text-center"><a
                    href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">@svg('heroicon-o-map-pin', 'w-4 h-4', ['style'
                    => 'color: #d3c281'])</a></p>
        </aside>
    </footer> --}}

    <footer class="footer footer-center bottom-0 bg-tsn-header text-primary-content">
        <p class="text-cente font-raleway">© Copyright TSN 1445 H/2024 M - All right reserved</p>
    </footer>

    @filamentScripts
    @vite('resources/js/app.js')

</body>

</html>
