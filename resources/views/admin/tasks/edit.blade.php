@extends('layouts.app')

@section('content')
    <div class="container min-vh-100 p-3">
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li class="btn btn-danger">{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        {{-- Card  --}}
        <div class="row">
            <div class="col mt-4">
                <h2 class="text-light">Your Task</h2>
                <div class="card p-2" style="width:24rem">
                    <div class="card-body">
                        <h5 class="card-title fs-3">Task title: <span class="fw-normal">{{ $task->title }}</span></h5>
                        @if ($task->description)
                            <p class="card-text"><span class="fs-6 fw-bold">Description:</span><br>{{ $task->description }}
                            </p>
                        @endif
                        @if ($task->date)
                            <p class="card-text"><span class="fw-bold">Expiration date:</span><br>{{ $task->date }}</p>
                        @endif
                        <a href="{{ route('admin.task.index') }}" class="btn text-light" style="background-color:#a3c58f"><i class="fa-solid fa-arrow-left-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="col mt-4">
                <h2 class="text-light">Edit</h2>
                <div class="card p-2" style="width:24rem">
                    <div class="card-body">
                        <form action="{{ route('admin.task.update', $task) }}" method="POST" class="form-input">
                            @csrf
                            @method('PUT')
                            <div class="row row-cols-1 pt-2">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Title of the Task</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Insert Task title">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Description of the Task</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Insert Task description">
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label fw-bold">Expiration Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ old('date', date('Y-m-d')) }}">
                                </div>
                                <div class="mb-3">
                                    <p class="fw-bold">Task is completed ?</p>
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="completed" id="completed"
                                            autocomplete="off" value="1">
                                        <label class="btn btn-outline-success" for="completed">Completed</label>

                                        <input type="radio" class="btn-check" name="completed" id="notCompleted"
                                            autocomplete="off" value="0">
                                        <label class="btn btn-outline-danger" for="notCompleted">Not Completed</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn mt-4 text-light w-50"
                                style="background-color:#a3c58f">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
