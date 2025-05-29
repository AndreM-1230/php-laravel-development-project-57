@extends('layouts.app', ['title' => 'Изменение задачи'])

@section('content')
    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name">@lang('Name')</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $task->name ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">@lang('Description')</label>
            <textarea class="form-control" id="description" name="description"
                      rows="3">{{ old('description', $task->description ?? '') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="status_id">@lang('Status')</label>
            <select class="form-control" id="status_id" name="status_id" required>
                <option value="">@lang('Select status')</option>
                @foreach($statuses as $id => $name)
                    <option value="{{ $id }}"
                        @selected(old('status_id', $task->status_id ?? '') == $id)>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="assigned_to_id">@lang('Assignee')</label>
            <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                <option value="">@lang('Select assignee')</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}"
                        @selected(old('assigned_to_id', $task->assigned_to_id ?? '') == $id)>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <select class="rounded border-gray-300 w-1/3 h-32" name="labels[]" id="labels[]" multiple="">
                @foreach($labels as $id => $name)
                    <option value="{{ $id }}"
                        @selected(in_array($id, old('labels', $task->labels->pluck('id')->toArray() ?? [])))>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
