@extends('layouts.app')


@section('content')
    <div class="container min-vh-100 d-flex flex-column">
        @if (count($tasks) > 0)
        <div class="btn-container align-self-end">
            <a href="{{ url()->previous()}}" class="btn btn-light my-3 align-self-end">Back</a>
            <a href="{{ route('admin.task.create') }}" class="btn btn-light my-3">Create Task</a>
        </div>
        @endif
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li class="btn btn-danger">{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5">
            @if (count($tasks) > 0)
                @foreach ($tasks as $task)
                    <div class="col mb-3 p-1">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"><span class="fw-bold">{{ $task->title }}</span></h5>
                                @if ($task->description)
                                    <p class="card-text"><span class="fs-6 fw-bold">Description:</span><br>{{ $task->description }}</p>
                                @endif
                                @if ($task->date)
                                    <p class="card-text"><span class="fs-6 fw-bold">Expires: </span>{{ $task->date }}</p>
                                @endif
                                @if ($task->completed == 0)
                                    <p class="card-text fw-bold">Completed<i
                                            class="ms-2 fa-solid fa-square-xmark fs-4 text-danger"></i></p>
                                @elseif ($task->completed == 1)
                                    <p class="card-text fw-bold">Completed<i
                                            class="ms-2 fa-solid fa-check fs-3 text-success"></i></p>
                                @endif
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.task.show', $task->id) }}"><i
                                            class="ms-2 fa-solid fa-circle-info fs-2 text-primary"></i></a>
                                    <a href="{{ route('admin.task.edit', $task) }}"><i
                                            class="ms-2 fa-solid fa-pen-to-square fs-2 text-warning"></i></a>

                                    <!-- Button trigger modal -->
                                    <i type="button" class="fa-solid fa-trash text-danger fs-2 ms-2" data-bs-toggle="modal"
                                        data-bs-target="#modalIndex"></i>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalIndex" tabindex="-1"
                                        aria-labelledby="modalIndexLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalIndexLabel">Warning !!!</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    You are deleting the task <span class="fs-5 fw-bold">{{$task->title}}</span> are you sure ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.task.destroy', $task) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirm
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container mt-4">
                    <h2 class="text-light">No Tasks create new one</h2>
                    <a href="{{ route('admin.task.create') }}" class="btn btn-light">Create Task</a>
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-secondary">Back</a>
                </div>
            @endif
        </div>
    </div>
@endsection
