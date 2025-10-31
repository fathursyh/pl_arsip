<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Arsip</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Hero Section -->
    <section
        class="bg-black/50 bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGJvb2tzfGVufDB8fDB8fHww&auto=format&fit=crop&q=60&w=600')] bg-cover bg-blend-multiply">
        <div class="mx-auto max-w-7xl px-4 py-8 text-center lg:py-16">
            <div class="mb-8">
                <svg class="mx-auto h-20 w-20 text-gray-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 1 0 0 4h16a2 2 0 1 0 0-4H4Zm0 6h16v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8Zm10.707 5.707a1 1 0 0 0-1.414-1.414l-.293.293V12a1 1 0 1 0-2 0v2.586l-.293-.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l2-2Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-50 md:text-5xl lg:text-6xl">
                Selamat Datang di Arsip Laili</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 sm:px-16 lg:text-xl xl:px-48">Sistem manajemen arsip dan
                peminjaman dokumen yang mudah, cepat, dan aman.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Login ke Sistem
                    <svg class="-mr-1 ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 lg:px-6 lg:py-16">
            <div class="mx-auto mb-8 max-w-3xl text-center lg:mb-12">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Statistik Sistem</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl">Data pengelolaan arsip dan peminjaman</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-3">
                <!-- Total Arsip -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 text-center shadow">
                    <div class="mb-4 flex items-center justify-center">
                        <svg class="h-12 w-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-5xl font-bold text-gray-900">1,247</h3>
                    <p class="font-medium text-gray-500">Total Arsip</p>
                </div>

                <!-- Total Users -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 text-center shadow">
                    <div class="mb-4 flex items-center justify-center">
                        <svg class="h-12 w-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-5xl font-bold text-gray-900">156</h3>
                    <p class="font-medium text-gray-500">Pengguna Aktif</p>
                </div>

                <!-- Peminjaman Berhasil -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 text-center shadow">
                    <div class="mb-4 flex items-center justify-center">
                        <svg class="h-12 w-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-5xl font-bold text-gray-900">892</h3>
                    <p class="font-medium text-gray-500">Peminjaman Berhasil</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:py-16 lg:px-6">
            <div class="mb-8 max-w-3xl lg:mb-16">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Fitur Unggulan</h2>
                <p class="text-gray-500 sm:text-xl">Kemudahan dalam mengelola arsip dan peminjaman dokumen</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 md:gap-8 md:space-y-0 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Z" />
                            <path fill-rule="evenodd"
                                d="M21.707 21.707a1 1 0 0 1-1.414 0l-3.5-3.5a1 1 0 0 1 1.414-1.414l3.5 3.5a1 1 0 0 1 0 1.414Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold">Pencarian Cepat</h3>
                    <p class="text-gray-500">Temukan arsip yang Anda butuhkan dengan sistem pencarian yang canggih dan
                        cepat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                            </path>
                            <path
                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Peminjaman Mudah</h3>
                    <p class="text-gray-500">Ajukan dan kelola peminjaman arsip secara digital dengan proses yang
                        sederhana.</p>
                </div>

                <!-- Feature 3 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Keamanan Terjamin</h3>
                    <p class="text-gray-500">Sistem keamanan berlapis untuk melindungi data dan dokumen arsip Anda.</p>
                </div>

                <!-- Feature 4 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Riwayat Lengkap</h3>
                    <p class="text-gray-500">Lacak semua aktivitas peminjaman dan pengembalian arsip dengan detail.</p>
                </div>

                <!-- Feature 5 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold">Notifikasi Peminjaman</h3>
                    <p class="text-gray-500">Dapatkan pemberitahuan otomatis untuk setiap pembaruan status peminjaman.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div
                        class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 lg:h-12 lg:w-12">
                        <svg class="h-5 w-5 text-blue-600 lg:h-6 lg:w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold">Laporan Otomatis</h3>
                    <p class="text-gray-500">Generate laporan penggunaan dan statistik arsip secara otomatis.</p>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>

</html>
