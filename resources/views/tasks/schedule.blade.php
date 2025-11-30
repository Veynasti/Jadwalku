@extends('layouts.app')

@section('title', 'Jadwal 7 Hari Kedepan')
@section('header', 'Jadwal 7 Hari Kedepan')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header Section --}}
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Jadwal 7 Hari Ke Depan</h2>
        <p class="text-white/80 text-lg">
            <i class="far fa-calendar-alt mr-2"></i>
            {{ $today->translatedFormat('d F Y') }} - {{ $nextWeek->translatedFormat('d F Y') }}
        </p>
    </div>

    {{-- Calendar Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-4">

        @for ($i = 0; $i < 7; $i++)
            @php
                $date = $today->copy()->addDays($i);
                $dateString = $date->toDateString();
                $tasks = $grouped->get($dateString) ?? collect();
                $isToday = $date->isToday();
            @endphp

            <div class="bg-white/95 backdrop-blur-sm shadow-md rounded-xl overflow-hidden border-t-4
                {{ $isToday ? 'border-blue-500' : 'border-gray-200' }}
                hover:shadow-xl transition-all duration-300 flex flex-col h-full">

                {{-- Card Header --}}
                <div class="p-4 {{ $isToday ? 'bg-linear-to-r from-blue-500 to-blue-600' : 'bg-gray-50' }}">
                    <div class="text-center">
                        <div class="text-sm font-semibold {{ $isToday ? 'text-white' : 'text-gray-500' }} uppercase tracking-wide">
                            {{ $date->translatedFormat('l') }}
                        </div>
                        <div class="text-2xl font-bold {{ $isToday ? 'text-white' : 'text-gray-800' }} mt-1">
                            {{ $date->format('d') }}
                        </div>
                        <div class="text-xs {{ $isToday ? 'text-white/90' : 'text-gray-500' }}">
                            {{ $date->translatedFormat('M Y') }}
                        </div>
                    </div>

                    @if($isToday)
                        <div class="mt-2 text-center">
                            <span class="inline-block px-2 py-1 bg-white/20 text-white text-xs font-semibold rounded-full">
                                Hari Ini
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Card Body --}}
                <div class="p-4 flex-1 overflow-y-auto max-h-[400px]">
                    @if ($tasks->count() > 0)
                        <div class="space-y-2">
                            @foreach ($tasks as $task)
                                <div class="group relative p-3 rounded-lg border-l-4 transition-all duration-200
                                    {{ $task->status == 'done'
                                        ? 'bg-green-50 border-green-500 hover:bg-green-100'
                                        : 'bg-blue-50 border-blue-500 hover:bg-blue-100'
                                    }}">

                                    <div class="flex items-start gap-2">
                                        @if($task->status == 'done')
                                            <i class="fas fa-check-circle text-green-600 mt-0.5 shrink-0"></i>
                                        @else
                                            <i class="far fa-circle text-blue-600 mt-0.5 shrink-0"></i>
                                        @endif

                                        <div class="flex-1 min-w-0">
                                            <div class="font-medium text-sm {{ $task->status == 'done' ? 'text-green-900 line-through' : 'text-blue-900' }}">
                                                {{ $task->title }}
                                            </div>

                                            @if($task->description)
                                                <div class="text-xs {{ $task->status == 'done' ? 'text-green-700' : 'text-blue-700' }} mt-1 line-clamp-2">
                                                    {{ $task->description }}
                                                </div>
                                            @endif

                                            @if($task->time)
                                                <div class="flex items-center gap-1 mt-2 text-xs {{ $task->status == 'done' ? 'text-green-600' : 'text-blue-600' }}">
                                                    <i class="far fa-clock"></i>
                                                    <span class="font-medium">
                                                        {{ \Carbon\Carbon::parse($task->time)->format('H:i') }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Status Badge --}}
                                    @if($task->status == 'done')
                                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="inline-block px-2 py-0.5 bg-green-600 text-white text-xs rounded-full">
                                                Selesai
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Task Counter --}}
                        <div class="mt-3 pt-3 border-t border-gray-200 text-center">
                            <span class="text-xs text-gray-600 font-medium">
                                {{ $tasks->count() }} {{ $tasks->count() > 1 ? 'kegiatan' : 'kegiatan' }}
                            </span>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-full min-h-[120px] text-center">
                            <i class="fas fa-calendar-day text-4xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-400 italic">Tidak ada kegiatan</p>
                        </div>
                    @endif
                </div>

            </div>
        @endfor

    </div>

    {{-- Summary Section --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-6 shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tasks text-blue-600 text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $grouped->flatten()->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Total Kegiatan</div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-6 shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $grouped->flatten()->where('status', 'done')->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Selesai</div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-6 shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $grouped->flatten()->where('status', '!=', 'done')->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Menunggu</div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
