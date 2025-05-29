@extends('layouts.app', ['title' => 'Задачи'])

@section('content')
    <div class="w-full flex items-center">
        <div>
            <form method="GET" action="{{ route('tasks.index') }}">
                <div class="flex">
                    <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                        <option value="" selected="selected">Статус</option>
                        @foreach($statuses as $id => $status)
                            <option value="{{$id}}">{{$status}}</option>
                        @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[created_by_id]" id="filter[created_by_id]">
                        <option value="" selected="selected">Автор</option>
                        @foreach($users as $id => $user)
                            <option value="{{$id}}">{{$user}}</option>
                        @endforeach
                    </select>
                    <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                        <option value="" selected="selected">Исполнитель</option>
                        @foreach($users as $id => $user)
                            <option value="{{$id}}">{{$user}}</option>
                        @endforeach
                    </select>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">Применить</button>

                </div></form>
        </div>

        @auth
            <div class="ml-auto">
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Создать задачу</a>
            </div>
        @endauth
    </div>



    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            <th>ID</th>
            <th>Статус</th>
            <th>Имя</th>
            <th>Автор</th>
            <th>Исполнитель</th>
            <th>Дата создания</th>
        </tr>
        </thead>
        @foreach($tasks as $task)
            <tr class="border-b border-dashed text-left">
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td><a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                <td>{{ $task->creator->name }}</td>
                <td>{{ $task->assignee?->name ?? '-' }}</td>
                <td>{{ $task->created_at->format('d.m.Y') }}</td>
                @auth
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">Изменить</a>
                        @if(Auth::id() === $task->created_by_id)
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">
                                    Удалить
                                </button>
                            </form>
                        @endif
                    </td>
                @endauth
            </tr>
        @endforeach
    </table>

    {{ $tasks->links() }}
@endsection
