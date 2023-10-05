@extends('layouts.app')

@section('content')
    <div class="container min-vh-100 d-flex flex-column">
        <div class="btn-container align-self-end">
            <a href="{{ url()->previous()}}" class="btn btn-outline-secondary my-3 align-self-end">Back</a>
            <a href="{{ route('admin.task.create') }}" class="btn btn-light my-3">Create Task</a>
        </div>
        <div class="row gap-2 p-4 justify-content-center">
            <div class="card col-5 p-0">
                <div class="card-body todos p-0">
                    <h5 class="card-title p-3 todo-title rounded-1 ">Todo</h5>
                    <div class="card-container">
                            @foreach ($todos as $task)
                                <a href="{{ route('admin.task.show', $task->id) }}" class="p-2 card-text d-flex justify-content-between border-bottom text-decoration-none text-dark">
                                    <p class="ms-2"><span>{{ $task->date }}</span><span class="ms-3 fw-bold">{{ $task->title }}</span></p>
                                    @if ($task->description)
                                        <p class="me-2 d-none d-md-block">{{ Str::limit($task->description, 40) }}</p>
                                    @endif
                                </a>
                            @endforeach
                    </div>
                </div>
            </div>
            <div class="card col-5 p-0">
                <div class="card-body todos p-0">
                    <h5 class="card-title p-3 todo-title rounded-1 ">Completed</h5>
                    <div class="card-container">
                            @foreach ($completed as $task)
                                <a href="{{ route('admin.task.show', $task->id) }}" class="my-2 card-text d-flex justify-content-between border-bottom text-decoration-none text-dark">
                                    <p class="ms-2"><span>{{ $task->date }}</span><span class="ms-3 fw-bold">{{ $task->title }}</span></p>
                                    @if ($task->description)
                                        <p class="me-2 d-none d-md-block">{{ Str::limit($task->description, 40) }}</p>
                                    @endif
                                </a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
