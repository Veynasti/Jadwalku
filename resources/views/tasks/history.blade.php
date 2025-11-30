@extends('layouts.app')

@section('title', 'Riwayat Kegiatan')
@section('header', 'Riwayat Kegiatan')

@section('content')

{{-- Header Section --}}
<div class="mb-8">
    <div class="bg-linear-to-r from-green-600 to-emerald-600 rounded-2xl p-8 shadow-xl text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">
                    <i class="fas fa-check-circle mr-2"></i>Riwayat Kegiatan
                </h1>
                <p class="text-white/90 text-lg">
                    Semua kegiatan yang telah diselesaikan
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-4xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stats Summary --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Selesai --}}
    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-double text-green-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Selesai</p>
                <p class="text-3xl font-bold text-gray-800">{{ $tasks->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Minggu Ini --}}
    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-week text-blue-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Minggu Ini</p>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $tasks->filter(function($task) {
                        return \Carbon\Carbon::parse($task->date)->isCurrentWeek();
                    })->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Bulan Ini --}}
    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Bulan Ini</p>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $tasks->filter(function($task) {
                        return \Carbon\Carbon::parse($task->date)->isCurrentMonth();
                    })->count() }}
                </p>
            </div>
        </div>
    </div>

</div>

{{-- Main Content --}}
<div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-list-check text-green-600 mr-2"></i>
            Kegiatan yang Sudah Selesai
        </h2>

        @if($tasks->count() > 0)
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <i class="fas fa-trophy text-yellow-500"></i>
                <span class="font-semibold">{{ $tasks->count() }} kegiatan diselesaikan!</span>
            </div>
        @endif
    </div>

    @if($tasks->count() == 0)
        <div class="text-center py-16">
            <div class="mb-6">
                <i class="fas fa-clipboard-check text-8xl text-gray-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Riwayat</h3>
            <p class="text-gray-500 mb-6">Kegiatan yang sudah diselesaikan akan muncul di sini</p>
            <a href="{{ route('tasks.index') }}"
                class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold">
                <i class="fas fa-plus mr-2"></i>Lihat Kegiatan
            </a>
        </div>
    @else
        {{-- Group by Month --}}
        @php
            $groupedTasks = $tasks->groupBy(function($task) {
                return \Carbon\Carbon::parse($task->date)->format('Y-m');
            })->sortKeysDesc();
        @endphp

        <div class="space-y-8">
            @foreach($groupedTasks as $month => $monthTasks)
                @php
                    $monthDate = \Carbon\Carbon::parse($month . '-01');
                @endphp

                {{-- Month Header --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-1 h-px bg-linear-to-r from-green-200 to-transparent"></div>
                        <h3 class="text-lg font-bold text-gray-700">
                            <i class="far fa-calendar mr-2 text-green-600"></i>
                            {{ $monthDate->translatedFormat('F Y') }}
                        </h3>
                        <div class="flex-1 h-px bg-linear-to-l from-green-200 to-transparent"></div>
                    </div>

                    {{-- Tasks in this month --}}
                    <div class="space-y-3">
                        @foreach($monthTasks as $task)
                            <div class="group relative p-5 bg-linear-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">

                                {{-- Decorative Elements --}}
                                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 bg-green-200/20 rounded-full"></div>
                                <div class="absolute bottom-0 right-0 -mr-4 -mb-4 w-16 h-16 bg-green-300/10 rounded-full"></div>

                                <div class="relative flex items-start justify-between gap-4">
                                    <div class="flex items-start gap-4 flex-1">
                                        {{-- Check Icon --}}
                                        <div class="mt-1">
                                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        </div>

                                        {{-- Task Info --}}
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-800 text-lg mb-1">
                                                {{ $task->title }}
                                            </h3>

                                            @if($task->description)
                                                <p class="text-gray-600 text-sm mb-3 leading-relaxed">
                                                    {{ $task->description }}
                                                </p>
                                            @endif

                                            <div class="flex flex-wrap items-center gap-3">
                                                {{-- Date Badge --}}
                                                <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 rounded-lg shadow-sm">
                                                    <i class="far fa-calendar-check text-green-600"></i>
                                                    <span class="text-sm font-semibold text-gray-700">
                                                        {{ \Carbon\Carbon::parse($task->date)->translatedFormat('d F Y') }}
                                                    </span>
                                                </div>

                                                {{-- Day Badge --}}
                                                <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 rounded-lg shadow-sm">
                                                    <i class="far fa-clock text-blue-600"></i>
                                                    <span class="text-sm font-semibold text-gray-700">
                                                        {{ \Carbon\Carbon::parse($task->date)->translatedFormat('l') }}
                                                    </span>
                                                </div>

                                                {{-- Time Since Completion --}}
                                                @php
                                                    $daysAgo = \Carbon\Carbon::parse($task->date)->diffInDays(now());
                                                @endphp
                                                @if($daysAgo == 0)
                                                    <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">
                                                        <i class="fas fa-star mr-1"></i>Hari Ini
                                                    </span>
                                                @elseif($daysAgo <= 7)
                                                    <span class="px-3 py-1.5 bg-purple-100 text-purple-700 rounded-lg text-xs font-bold">
                                                        {{ $daysAgo }} hari lalu
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status Badge --}}
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="px-4 py-2 bg-linear-to-r from-green-600 to-emerald-600 text-white rounded-xl text-sm font-bold shadow-md whitespace-nowrap">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                        </span>

                                        {{-- Achievement Badge --}}
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-bold">
                                                <i class="fas fa-trophy mr-1"></i>Achievement
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Achievement Section --}}
        @if($tasks->count() >= 5)
            <div class="mt-8 bg-linear-to-r from-yellow-400 to-orange-500 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-trophy text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Luar Biasa! 🎉</h3>
                        <p class="text-white/90">
                            Kamu telah menyelesaikan <span class="font-bold">{{ $tasks->count() }} kegiatan</span>! Tetap pertahankan produktivitasmu!
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

@endsection
