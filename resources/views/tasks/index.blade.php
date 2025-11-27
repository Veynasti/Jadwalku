@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-white">To-Do List</h1>

        <a href="{{ route('tasks.create') }}">
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold">
            + Tambah Task
        </a>
    </div>
</div>
