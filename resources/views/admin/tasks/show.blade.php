@extends('layouts.app')


@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-2" style="min-height:14rem">
            <div class="card-body">
                <h5 class="card-title fs-3">Task title: <span class="fw-normal">{{ $task->title }}</span></h5>
                @if ($task->description)
                    <p class="card-text"><strong class="fs-6">Description:</strong><br>{{ $task->description }}</p>
                @endif
                @if ($task->date)
                    <p class="card-text"><span class="fs-6 fw-bold">Expires: </span>{{ $task->date }}</p>
                @endif
                @if ($task->completed == 0)
                    <p class="card-text fw-bold">Completed<i class="ms-2 fa-solid fa-square-xmark fs-4 text-danger"></i></p>
                @elseif ($task->completed == 1)
                    <p class="card-text fw-bold">Completed<i class="ms-2 fa-solid fa-check fs-3 text-success"></i></p>
                @endif
                <div class="d-flex">
                    <a href="{{ route('admin.task.index') }}" class="btn text-light" style="background-color:#a3c58f"><i
                            class="fa-solid fa-arrow-left-long"></i></a>
                    <a class="ms-2" href="{{ route('admin.task.edit', $task) }}"><i
                            class="ms-2 fa-solid fa-pen-to-square fs-2 text-warning"></i></a>
                    <!-- Button trigger modal -->
                    <i type="button" class="fa-solid fa-trash text-danger fs-2 ms-2" data-bs-toggle="modal"
                        data-bs-target="#modalShow"></i>
                    <!-- Modal -->
                    <div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalShowLabel">Warning !!!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    You are deleting the task <span class="fs-5 fw-bold">{{ $task->title }}</span> are you
                                    sure ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
@endsection
