@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                    Logout
                </button>
            </form>
        </div>

        {{-- Kartu Welcome wok --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="text-xl font-semibold">Halo, {{ auth()->user()->name }}</h3>
            <p class="text-gray-600 mt-2">Selamat datang di sistem Jadwalku.</p>
        </div>
    </div>
</div>
