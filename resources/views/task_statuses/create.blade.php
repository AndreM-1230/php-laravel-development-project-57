@extends('layouts.app', ['title' => 'Создать статус'])

@section('content')
    <form class="w-50" method="POST" action="{{ route('task_statuses.store') }}">
        @csrf
        <div class="flex flex-col">
            <div>
                <label for="name">Имя</label>
            </div>
            <div class="mt-2">
                <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ old('name', $taskStatus->name ?? '') }}">
            </div>
            @if($errors->get('name'))
            <div class="text-rose-600">{{$errors->get('name')[0]}}</div>
            @endif
            <div class="mt-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Создать</button>
            </div>
        </div>
    </form>
@endsection
