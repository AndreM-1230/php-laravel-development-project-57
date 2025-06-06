@extends('layouts.app', ['title' => 'Метки'])

@section('content')
    @auth
    <div>
        <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Создать метку</a>
    </div>
    @endauth
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Описание</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($labels as $label)
            <tr class="border-b border-dashed text-left">
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at }}</td>
                <td>
                    @auth
                    <a href="#" class="btn btn-sm text-red-600 hover:text-red-900" onclick="if(confirm('Вы уверены?')) { event.preventDefault(); document.getElementById('delete-form-{{ $label->id }}').submit();}">
                        Удалить
                    </a>
                    <form id="delete-form-{{ $label->id }}" action="{{ route('labels.destroy', $label) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">Изменить</a>
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody></table>
@endsection
