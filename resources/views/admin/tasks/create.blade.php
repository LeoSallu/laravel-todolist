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
        <div class="col mt-4">
            <h2 class="text-light">Create your Task</h2>
            <div class="card p-2" style="width:24rem">
                <div class="card-body">
                    <form action="{{ route('admin.task.store') }}" method="POST" class="form-input">
                        @csrf
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
                                <label for="date" class="form-label fw-bold">Description of the Task</label>
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
                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.task.index') }}" class="btn btn-danger"><i
                                class="fa-solid fa-arrow-left-long"></i></a>
                            <button type="submit" class="ms-2 btn text-light" style="background-color:#a3c58f">Create</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
