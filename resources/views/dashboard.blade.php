@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

{{-- Welcome Section --}}
<div class="mb-8">
    <div class="bg-linear-to-r from-blue-600 to-purple-600 rounded-2xl p-8 shadow-xl text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-white/90 text-lg">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-calendar-check text-6xl text-white/20"></i>
            </div>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- CARD TOTAL TASK --}}
    <div class="bg-linear-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden relative">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 bg-white/5 rounded-full"></div>

        <div class="relative p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-list text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-white/80 text-sm font-medium">Total</p>
                    <p class="text-4xl font-bold">{{ $tasks->count() }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold">Total Kegiatan</h3>
        </div>
    </div>

    {{-- CARD TASK SELESAI --}}
    <div class="bg-linear-to-br from-green-500 to-green-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden relative">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 bg-white/5 rounded-full"></div>

        <div class="relative p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-white/80 text-sm font-medium">Selesai</p>
                    <p class="text-4xl font-bold">{{ $tasks->where('status', 'done')->count() }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold">Kegiatan Selesai</h3>
        </div>
    </div>

    {{-- CARD TASK PENDING --}}
    <div class="bg-linear-to-br from-yellow-500 to-orange-500 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden relative">
        <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 bg-white/5 rounded-full"></div>

        <div class="relative p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-hourglass-half text-2xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-white/80 text-sm font-medium">Pending</p>
                    <p class="text-4xl font-bold">{{ $tasks->where('status', 'pending')->count() }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold">Belum Selesai</h3>
        </div>
    </div>

</div>

{{-- Progress Bar --}}
@php
    $totalTasks = $tasks->count();
    $doneTasks = $tasks->where('status', 'done')->count();
    $progress = $totalTasks > 0 ? ($doneTasks / $totalTasks) * 100 : 0;
@endphp

@if($totalTasks > 0)
<div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg font-semibold text-gray-700">Progress Keseluruhan</h3>
        <span class="text-2xl font-bold text-blue-600">{{ number_format($progress, 0) }}%</span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div class="bg-linear-to-r from-blue-500 to-green-500 h-full rounded-full transition-all duration-500 flex items-center justify-end pr-2"
            style="width: {{ $progress }}%">
            @if($progress > 10)
                <span class="text-xs font-semibold text-white">{{ $doneTasks }}/{{ $totalTasks }}</span>
            @endif
        </div>
    </div>

    <p class="text-sm text-gray-600 mt-2">
        {{ $doneTasks }} dari {{ $totalTasks }} kegiatan telah diselesaikan
    </p>
</div>
@endif

{{-- Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

    {{-- Kegiatan Hari Ini --}}
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-blue-600"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700">Kegiatan Hari Ini</h3>
        </div>

        @php
            $todayTasks = $tasks->filter(function($task) {
                return \Carbon\Carbon::parse($task->date)->isToday();
            });
        @endphp

        @if($todayTasks->count() > 0)
            <div class="space-y-2">
                @foreach($todayTasks->take(3) as $task)
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-2 h-2 rounded-full {{ $task->status == 'done' ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
                        <span class="text-sm text-gray-700 flex-1">{{ $task->title }}</span>
                        @if($task->status == 'done')
                            <i class="fas fa-check text-green-500 text-xs"></i>
                        @endif
                    </div>
                @endforeach

                @if($todayTasks->count() > 3)
                    <p class="text-sm text-gray-500 text-center mt-2">
                        +{{ $todayTasks->count() - 3 }} kegiatan lainnya
                    </p>
                @endif
            </div>
        @else
            <div class="text-center py-6">
                <i class="fas fa-check-circle text-4xl text-green-400 mb-2"></i>
                <p class="text-gray-500 text-sm">Tidak ada kegiatan hari ini</p>
            </div>
        @endif
    </div>

    {{-- Kegiatan Mendatang --}}
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-purple-600"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700">Kegiatan Mendatang</h3>
        </div>

        @php
            $upcomingTasks = $tasks->filter(function($task) {
                return \Carbon\Carbon::parse($task->date)->isFuture() && $task->status != 'done';
            })->sortBy('date');
        @endphp

        @if($upcomingTasks->count() > 0)
            <div class="space-y-2">
                @foreach($upcomingTasks->take(3) as $task)
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="text-xs font-semibold text-gray-600 bg-gray-200 px-2 py-1 rounded">
                            {{ \Carbon\Carbon::parse($task->date)->format('d M') }}
                        </div>
                        <span class="text-sm text-gray-700 flex-1">{{ $task->title }}</span>
                    </div>
                @endforeach

                @if($upcomingTasks->count() > 3)
                    <p class="text-sm text-gray-500 text-center mt-2">
                        +{{ $upcomingTasks->count() - 3 }} kegiatan lainnya
                    </p>
                @endif
            </div>
        @else
            <div class="text-center py-6">
                <i class="fas fa-calendar-check text-4xl text-gray-300 mb-2"></i>
                <p class="text-gray-500 text-sm">Tidak ada kegiatan mendatang</p>
            </div>
        @endif
    </div>

</div>

{{-- RECENT TASK LIST --}}
<div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-linear-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-tasks text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Semua Kegiatan</h3>
        </div>

        <a href="{{ route('tasks.index') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
            <i class="fas fa-arrow-right mr-2"></i>Buat Kegiatan
        </a>
    </div>

    @if($tasks->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg font-semibold mb-2">Belum ada kegiatan</p>
            <p class="text-gray-400 text-sm mb-6">Mulai tambahkan kegiatan untuk mengatur jadwalmu</p>
            <a href="{{ route('tasks.index') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach ($tasks->take(5) as $task)
                <div class="group p-4 bg-linear-to-r from-gray-50 to-white rounded-xl border-l-4
                    {{ $task->status == 'done' ? 'border-green-500' : 'border-yellow-500' }}
                    hover:shadow-md transition-all duration-200">

                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3 flex-1">
                            <div class="mt-1">
                                @if($task->status == 'done')
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                @else
                                    <i class="far fa-circle text-yellow-500 text-lg"></i>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 {{ $task->status == 'done' ? 'line-through' : '' }}">
                                    {{ $task->title }}
                                </h4>

                                @if($task->description)
                                    <p class="text-gray-600 text-sm mt-1 line-clamp-1">
                                        {{ $task->description }}
                                    </p>
                                @endif

                                <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($task->date)->translatedFormat('d M Y') }}
                                    </span>

                                    @php
                                        $taskDate = \Carbon\Carbon::parse($task->date);
                                    @endphp

                                    @if($taskDate->isToday())
                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-semibold">
                                            Hari Ini
                                        </span>
                                    @elseif($taskDate->isTomorrow())
                                        <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full font-semibold">
                                            Besok
                                        </span>
                                    @elseif($taskDate->isPast() && $task->status != 'done')
                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full font-semibold">
                                            Terlambat
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <span class="px-3 py-1.5 text-xs rounded-full font-semibold whitespace-nowrap
                            {{ $task->status == 'done'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            <i class="fas {{ $task->status == 'done' ? 'fa-check' : 'fa-hourglass-half' }} mr-1"></i>
                            {{ $task->status == 'done' ? 'Selesai' : 'Menunggu' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        @if($tasks->count() > 5)
            <div class="mt-4 text-center">
                <a href="{{ route('tasks.index') }}"
                    class="inline-block text-blue-600 hover:text-blue-700 font-semibold text-sm">
                    Lihat {{ $tasks->count() - 5 }} kegiatan lainnya →
                </a>
            </div>
        @endif
    @endif
</div>

@endsection
