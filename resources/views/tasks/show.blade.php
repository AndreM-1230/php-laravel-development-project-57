@extends('layouts.app')

@section('content')
    <h2 class="mb-5">
        Просмотр задачи: {{$task->name}}<a href="{{route('tasks.edit', $task)}}">⚙</a>
    </h2>
    <p><span class="font-black">Имя:</span> {{$task->name}}</p>
    <p><span class="font-black">Статус:</span> {{$task->status->name}}</p>
    <p><span class="font-black">Описание:</span> {{$task->description}}</p>
    <p><span class="font-black">Метки:</span></p>
    <div>
        @foreach($task->labels as $label)
        <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
           {{$label->name}}
        </div>
        @endforeach
    </div>
@endsection
