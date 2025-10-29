@extends('layouts.auth-layout')

@section('title', 'Masuk Akun')

@section('main')
    <section class="bg-gray-50">
        <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
            <a href="{{ route('home') }}" class="mb-6 flex items-center text-2xl font-semibold text-gray-900">
                <img class="mr-2 h-8 w-8" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                Semangat Laili
            </a>
            <div class="w-full rounded-lg border border-gray-300 bg-white shadow sm:max-w-md md:mt-0 xl:p-0">
                <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Masuk ke dalam akun
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('auth.login') }}" method="POST" novalidate>
                        @method('POST')
                        @csrf
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900">Alamat Email</label>
                            <input type="email" name="email" id="email"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900" autofocus
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <p class="ms-1 mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900"
                            >
                            @error('password')
                                <p class="ms-1 mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex h-5 items-center">
                                    <input id="remember" name="remember" aria-describedby="remember" type="checkbox"
                                        class="focus:ring-3 focus:ring-primary-300 h-4 w-4 rounded border border-gray-300 bg-gray-50" value="1">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500">Ingat saya</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                            Masuk
                        </button>
                        <p class="text-sm font-light text-gray-500">
                            Anda belum memiliki akun? <a href="#"
                                class="text-primary-600 font-medium hover:underline">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
