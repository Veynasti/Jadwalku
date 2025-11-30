@extends('layouts.app')

@section('title', 'To-Do List')
@section('header', 'To-Do List')

@section('content')
<div x-data="{
    openModal: false,
    openEdit: false,
    openDone: false,
    openDelete: false,
    editData: { id: '', title: '', description: '', date: '' },
    selectedTaskId: ''
}">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl text-white font-bold">Daftar Kegiatan</h1>

        <button @click="openModal = true"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
        </button>
    </div>

    {{-- Jika tidak ada task --}}
    @if ($tasks->isEmpty())
        <div class="p-12 bg-white/90 backdrop-blur-sm rounded-xl text-gray-600 text-center shadow-lg">
            <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4"></i>
            <p class="text-lg font-semibold">Belum ada kegiatan</p>
            <p class="text-sm text-gray-500 mt-2">Silakan tambah kegiatan baru untuk memulai</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($tasks as $task)
                <div class="p-5 rounded-xl bg-white/90 backdrop-blur-sm shadow-md hover:shadow-lg transition-all flex justify-between items-start
                    {{ $task->status == 'done' ? 'border-l-4 border-green-500' : 'border-l-4 border-yellow-500' }}">

                    <div class="flex-1">
                        <h2 class="text-lg font-semibold {{ $task->status == 'done' ? 'line-through text-gray-500' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </h2>

                        @if($task->description)
                            <p class="text-gray-600 text-sm mb-2 mt-1">{{ $task->description }}</p>
                        @endif

                        <p class="text-sm font-medium text-gray-700 flex items-center gap-2 mt-2">
                            <i class="far fa-clock"></i>
                            {{ \Carbon\Carbon::parse($task->date)->format('d M Y') }}
                        </p>

                        {{-- Badge Status --}}
                        @if($task->status == 'done')
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold bg-green-600 text-white rounded-full">
                                <i class="fas fa-check mr-1"></i> Selesai
                            </span>
                        @else
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold bg-yellow-500 text-white rounded-full">
                                <i class="fas fa-hourglass-half mr-1"></i> Menunggu
                            </span>
                        @endif
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col items-end gap-2 ml-4 min-w-[140px]">

                        {{-- Tandai Selesai --}}
                        @if ($task->status != 'done')
                            <button @click="openDone = true; selectedTaskId = {{ $task->id }}"
                                class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm transition-colors">
                                <i class="fas fa-check mr-1"></i> Selesai
                            </button>
                        @endif

                        {{-- Edit --}}
                        <button @click="
                            openEdit = true;
                            editData = {
                                id: {{ $task->id }},
                                title: {{ json_encode($task->title) }},
                                description: {{ json_encode($task->description ?? '') }},
                                date: '{{ $task->date }}',
                                status: '{{ $task->status }}'
                            }
                        " class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm transition-colors">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>

                        {{-- Hapus --}}
                        <button @click="openDelete = true; selectedTaskId = {{ $task->id }}"
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ============================= --}}
    {{-- MODAL TAMBAH KEGIATAN --}}
    {{-- ============================= --}}
    <div x-show="openModal"
        x-transition.opacity
        @click="openModal = false"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50">

        <div @click.stop
            class="bg-white rounded-xl w-full max-w-lg p-6 shadow-xl">

            <h2 class="text-2xl font-bold text-gray-700 mb-4">Tambah Kegiatan</h2>

            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Judul</label>
                    <input type="text" name="title" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tanggal</label>
                    <input type="date" name="date" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="openModal = false"
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT KEGIATAN --}}
    <div x-show="openEdit"
        x-transition.opacity
        @click="openEdit = false"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50">

        <div @click.stop
            class="bg-white rounded-xl w-full max-w-lg p-6 shadow-xl">

            <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Kegiatan</h2>

            <form :action="`{{ url('/tasks') }}/${editData.id}`" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Judul</label>
                    <input type="text" name="title" x-model="editData.title" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="description" x-model="editData.description" rows="3"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tanggal</label>
                    <input type="date" name="date" x-model="editData.date" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="openEdit = false"
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MODAL TANDAI SELESAI --}}
    {{-- ============================= --}}
    <div x-show="openDone"
        x-transition.opacity
        @click="openDone = false"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50">

        <div @click.stop
            class="bg-white rounded-xl w-full max-w-md p-6 shadow-xl">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-700">Tandai Selesai</h2>
            </div>

            <p class="text-gray-600 mb-6">Yakin ingin menandai kegiatan ini sebagai selesai?</p>

            <form :action="`/tasks/${selectedTaskId}/done`" method="POST">
                @csrf
                @method('PUT')

                <div class="flex justify-end gap-3">
                    <button type="button" @click="openDone = false"
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-check mr-1"></i> Ya, Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MODAL HAPUS KEGIATAN --}}
    {{-- ============================= --}}
    <div x-show="openDelete"
        x-transition.opacity
        @click="openDelete = false"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50">

        <div @click.stop
            class="bg-white rounded-xl w-full max-w-md p-6 shadow-xl">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-trash text-red-600 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-red-600">Hapus Kegiatan</h2>
            </div>

            <p class="text-gray-600 mb-6">Yakin ingin menghapus kegiatan ini? Tindakan ini tidak dapat dibatalkan.</p>

            <form :action="`/tasks/${selectedTaskId}`" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <button type="button" @click="openDelete = false"
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-1"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
