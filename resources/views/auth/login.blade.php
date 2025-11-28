@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="text-center mb-6">
    <h1 class="text-3xl font-bold text-green-600 mb-2">Selamat Datang</h1>
    <p class="text-gray-200">Ayo masuk dan lihat jadwalmu!</p>
</div>

<form class="space-y-6" method="POST" action="{{ route('login') }}">
    @csrf

    {{-- Email --}}
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
        <div class="relative">
            <input
                id="email"
                name="email"
                type="email"
                required
                autocomplete="email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-lg bg-white/40 text-gray-900
                        focus:outline-none focus:ring-2 focus:ring-green-500 pr-10
                        @error('email') border border-red-500 @enderror"
                placeholder="Enter your email">

            <i class="fa-solid fa-envelope absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
        </div>
        @error('email')
            <p class="text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-200">Password</label>

        <div class="relative">
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="current-password"
                class="w-full px-4 py-3 rounded-lg bg-white/40 text-gray-900
                        focus:outline-none focus:ring-2 focus:ring-green-500 pr-10
                        @error('password') border border-red-500 @enderror"
                placeholder="Enter your password">

            {{-- Eye Icon --}}
            <button
                type="button"
                onclick="togglePassword()"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                <i id="eye-icon" class="fa-solid fa-eye"></i>
            </button>
        </div>

        @error('password')
            <p class="text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    {{-- Remember --}}
    <div class="flex items-center">
        <input id="remember" name="remember" type="checkbox"
                class="h-4 w-4 text-green-600 rounded focus:ring-green-600 bg-white/40 border-gray-300">
        <label for="remember" class="ml-2 text-sm text-gray-200">Ingatkan Saya</label>
    </div>

    {{-- Login Button --}}
    <button
        type="submit"
        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg
                transition duration-200">
        Log in
    </button>

    {{-- Register Link --}}
    <p class="text-center text-sm text-gray-200 pt-4 border-t border-white/20">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-green-400 font-semibold hover:underline">
            Daftar
        </a>
    </p>
</form>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

@endsection
