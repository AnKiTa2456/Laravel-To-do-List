@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>My Todos</h3>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New</a>
    </div>
    <div class="card-body">
        @if (count($todos) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                            <tr>
                                <td>{{ $todo->title }}</td>
                                <td>
                                    @if ($todo->completed)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $todo->created_at->format('Y-m-d H:i') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('todos.show', $todo) }}" class="btn btn-info btn-sm me-1">View</a>
                                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No todos found. Create your first todo!</p>
        @endif
    </div>
</div>
@endsection