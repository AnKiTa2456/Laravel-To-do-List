@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Todo</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('todos.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $todo->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $todo->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="completed" name="completed" {{ $todo->completed ? 'checked' : '' }}>
                <label class="form-check-label" for="completed">Mark as Completed</label>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Todo</button>
            </div>
        </form>
    </div>
</div>
@endsection