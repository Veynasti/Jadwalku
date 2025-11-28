<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Nampilin semua task user
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('date', 'asc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    // Form tambah task
    public function create()
    {
        return view('tasks.create');
    }

    // Ngesimpan task baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan');
    }

    // Form edit task
    public function edit(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'status' => 'required|in:pending,done',
        ]);

        $task->update([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'status'      => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui!');
    }

    // Hapus task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus!');
    }

    // Tandai task sebagai selesai
    public function done(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['status' => 'done']);

        return redirect()->route('tasks.index')->with('success', 'Task selesai!');
    }
}
