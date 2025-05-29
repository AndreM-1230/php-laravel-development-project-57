@extends('layouts.app')

@section('content')
    <h2 class="mb-5">
        Просмотр задачи: {{$task->name}}<a href="{{route('tasks.edit', $task)}}">⚙</a>
    </h2>
    <p><span class="font-black">Имя:</span> {{$task->name}}</p>
    <p><span class="font-black">Статус:</span> {{$task->status->name}}</p>
    <p><span class="font-black">Описание:</span> {{$task->description}}</p>
    <p><span class="font-black">Метки:</span></p>
@endsection
