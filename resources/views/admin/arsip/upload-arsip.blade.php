@extends('layouts.dashboard-layout')

@section('title', 'Import Arsip')
@section('dashboard-title', 'Import Data Arsip')
@section('dashboard-desc', 'Upload file CSV untuk menambahkan data arsip secara massal.')

@section('main')
<section class="max-w-3xl">

    <div class="mb-6">
        <a href="{{ route('arsip.index') }}" class="flex items-center text-sm text-gray-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Arsip
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">

        {{-- Alerts Section --}}
        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <span class="font-bold">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <span class="font-bold">Gagal!</span> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('arsip.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900">Upload File CSV</label>
                <div class="flex items-center justify-center w-full">
                    {{-- ADDED ID "dropzone-wrapper" HERE --}}
                    <label id="dropzone-wrapper" for="dropzone-file" class="flex flex-col items-center justify-center w-full h-52 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 pointer-events-none">
                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-gray-500">Format: .CSV atau .TXT (Maks. 2MB)</p>
                            <p id="file-name" class="mt-2 text-sm font-semibold text-blue-600 hidden"></p>
                        </div>
                        <input id="dropzone-file" type="file" name="csv_file" class="hidden" accept=".csv, .txt" required />
                    </label>
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-sm text-blue-700 font-bold mb-1">Struktur Kolom CSV:</p>
                <p class="text-xs text-blue-600">Pastikan file Anda memiliki kolom berikut:</p>
                <ul class="list-disc list-inside text-xs text-blue-600 mt-1">
                    <li>Nomor Risalah</li>
                    <li>Pemohon</li>
                    <li>Jenis Lelang (jenis1 / jenis2)</li>
                    <li>Uraian Barang</li>
                </ul>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('arsip.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                    Batal
                </a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Import Data Sekarang
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    const dropzone = document.getElementById('dropzone-wrapper');
    const fileInput = document.getElementById('dropzone-file');
    const fileNameDisplay = document.getElementById('file-name');

    // 1. Handle Click Selection (Existing Logic)
    fileInput.addEventListener('change', function(e) {
        updateFileName(this.files[0]);
    });

    // 2. Prevent default drag behaviors
    // This stops the browser from opening the file in a new tab when dropped
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // 3. Add visual feedback when dragging over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropzone.classList.add('bg-blue-50', 'border-blue-400');
        dropzone.classList.remove('bg-gray-50', 'border-gray-300');
    }

    function unhighlight(e) {
        dropzone.classList.remove('bg-blue-50', 'border-blue-400');
        dropzone.classList.add('bg-gray-50', 'border-gray-300');
    }

    // 4. Handle the DROP event
    dropzone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            // Manually assign the dropped files to the hidden input
            fileInput.files = files;
            updateFileName(files[0]);
        }
    }

    // Helper to update text
    function updateFileName(file) {
        if (file) {
            fileNameDisplay.textContent = "File Terpilih: " + file.name;
            fileNameDisplay.classList.remove('hidden');
        }
    }
</script>
@endsection
