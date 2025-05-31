@extends('layouts.app', ['title' => 'Создать задачу'])

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="flex flex-col">
            <div>
                <label for="name">Имя</label>
            </div>
            <div class="mt-2">
                <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ old('name', $task->name ?? '') }}">
            </div>
            @if($errors->get('name'))
                <div class="text-rose-600">{{$errors->get('name')[0]}}</div>
            @endif
            <div class="mt-2">
                <label for="description">Описание</label>
            </div>
            <div>
                <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" id="description">{{ old('description', $task->description ?? '') }}</textarea>
            </div>
            <div class="mt-2">
                <label for="status_id">Статус</label>
            </div>
            <div>
                <select class="rounded border-gray-300 w-1/3" id="status_id" name="status_id" required>
                    <option value=""></option>
                    @foreach($statuses as $id => $name)
                        <option value="{{ $id }}"
                            @selected(old('status_id', $task->status_id ?? '') == $id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label for="status_id">Исполнитель</label>
            </div>
            <div>
                <select class="rounded border-gray-300 w-1/3" id="assigned_to_id" name="assigned_to_id">
                    <option value=""></option>
                    @foreach($users as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label for="status_id">Метки</label>
            </div>
            <div>
                <select class="rounded border-gray-300 w-1/3 h-32" name="labels[]" id="labels[]" multiple="">
                    @foreach($labels as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Создать</button>
            </div>
        </div>
    </form>
@endsection
