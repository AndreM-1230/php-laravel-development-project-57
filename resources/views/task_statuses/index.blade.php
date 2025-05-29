@extends('layouts.app', ['title' => 'Статусы'])

@section('content')
    @auth
        <div>
            <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Создать статус</a>
        </div>
    @endauth
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата создания</th>
        </tr>
        </thead>
        <tbody>
        @foreach($statuses as $status)
            <tr class="border-b border-dashed text-left">
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at->format('d.m.Y') }}</td>
                <td>
                @auth
                    @if($status->tasks->isEmpty())
                        <form action="{{ route('task_statuses.destroy', $status) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-red-600 hover:text-red-900" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    @endif
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">Изменить</a>
                @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
