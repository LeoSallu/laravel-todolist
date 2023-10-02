@extends('layouts.app')


@section('content')
    <div class="container p-3 mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Expiration Date</th>
                    <th scope="col">Completed</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->date }}</td>
                        @if ($task->completed === 1)
                            <td class="text-success"><i class="text-center fa-solid fa-check"></i></td>
                        @elseif ($task->completed === 0)
                            <td><i class="text-center fa-solid fa-square-xmark text-danger"></i></td>
                        @endif
                        <td class="d-flex">
                            {{-- Show  --}}
                            <a href="{{ route('admin.task.show', $task->id) }}"><i
                                    class="fa-solid fa-circle-info fs-4 text-primary"></i></a>
                            {{-- Edit  --}}
                            <a href="{{ route('admin.task.edit', $task->id) }}"><i
                                    class="fa-regular fa-pen-to-square fs-4 mx-2 text-warning"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('admin.profile.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <i role="button" class="fa-solid fa-trash fs-4 text-danger"></i>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
