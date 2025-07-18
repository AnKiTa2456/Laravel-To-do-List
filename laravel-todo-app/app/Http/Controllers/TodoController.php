<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Make sure this import is present

class TodoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $todos = Auth::user()->todos()->latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function show(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->has('completed'),
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }
}