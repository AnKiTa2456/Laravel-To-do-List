@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Todo Details</h3>
        <div>
            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this todo?')">Delete</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <h5 class="card-title">{{ $todo->title }}</h5>
            <p class="text-muted">
                Status: 
                @if ($todo->completed)
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </p>
            <p class="text-muted">Created: {{ $todo->created_at->format('F d, Y g:i A') }}</p>
            <p class="text-muted">Last Updated: {{ $todo->updated_at->format('F d, Y g:i A') }}</p>
        </div>
        
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Description</h5>
            </div>
            <div class="card-body">
                @if ($todo->description)
                    <p class="card-text">{{ $todo->description }}</p>
                @else
                    <p class="text-muted">No description provided.</p>
                @endif
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back to List</a>
            <form action="{{ route('todos.update', $todo) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $todo->title }}">
                <input type="hidden" name="description" value="{{ $todo->description }}">
                <input type="hidden" name="completed" value="{{ $todo->completed ? '0' : '1' }}">
                <button type="submit" class="btn {{ $todo->completed ? 'btn-warning' : 'btn-success' }}">
                    {{ $todo->completed ? 'Mark as Pending' : 'Mark as Completed' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection