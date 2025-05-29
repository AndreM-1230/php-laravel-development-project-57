@extends('layouts.app', ['title' => 'Создать метку'])

@section('content')
    <form class="w-50" method="POST" action="{{ route('labels.store') }}">
        @csrf
        <div class="flex flex-col">
            <div>
                <label for="name">Имя</label>
            </div>
            <div class="mt-2">
                <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name">
            </div>
            <div class="mt-2">
                <label for="description">Описание</label>
            </div>
            <div class="mt-2">
                <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" id="description"></textarea>
            </div>
            <div class="mt-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Создать</button>
            </div>
        </div>
    </form>
@endsection
