@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Tambah Pengguna')
@section('dashboard-title', 'Tambah Pengguna Baru')
@section('dashboard-desc', 'Isi detail pengguna untuk membuat akun baru.')

@section('main')
    <section class="max-w-4xl">
        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300">
                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4m-4-4 4-4"/>
                </svg>
                Kembali
            </a>
        </div>

        @php
            $divisions = ['marketing', 'it']; // Use your actual DivisionEnum::values() here
        @endphp

        <div class="rounded-lg bg-white p-6 shadow-md">
            {{-- Form for creating a new user --}}
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="grid gap-6 sm:grid-cols-2">

                    {{-- NIP (Nomahor Induk Pegawai) --}}
                    <div class="sm:col-span-1">
                        <label for="nip" class="mb-2 block text-sm font-medium text-gray-900">NIP</label>
                        <input type="text" name="nip" id="nip"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('nip') border-red-500 @enderror"
                            placeholder="Contoh: 12345678" value="{{ old('nip') }}" required>
                        @error('nip')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="sm:col-span-1">
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Nama Lengkap Pengguna" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Division (UPDATED TO SELECT) --}}
                    <div>
                        <label for="division" class="mb-2 block text-sm font-medium text-gray-900">Divisi</label>
                        <select id="division" name="division"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('division') border-red-500 @enderror" required>
                            <option value="" disabled selected>Pilih Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division }}" {{ old('division') == $division ? 'selected' : '' }}>
                                    {{ Str::ucfirst($division) }}
                                </option>
                            @endforeach
                        </select>
                        @error('division')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="mb-2 block text-sm font-medium text-gray-900">Role</label>
                        <select id="role" name="role"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-900">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    </div>

                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="mt-6 w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:w-auto">
                    Simpan Pengguna
                </button>
            </form>
        </div>
    </section>
@endsection
