<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Todo APP</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <form method="POST" action="{{ route('tasks.complete', $task->id) }}">
                        @csrf
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                        <span class="{{ $task->is_completed ? 'text-decoration-line-through' : '' }}">{{ $task->title }}</span>
                    </form>

                    <div>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="title" value="{{ $task->title }}" required>
                            <button type="submit" class="btn btn-warning btn-sm">Update</button>
                        </form>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
