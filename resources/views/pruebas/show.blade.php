@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('tareas-update', ['id'=> $todo->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            @if(session('success'))
                <h6 class='alert alert-success'>{{ session('success') }}</h6>
            @endif

            @error('title')
                <h6 class='alert alert-danger'>{{ $message }}</h6>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Título de la Tarea</label>
                <input type="text" class="form-control" name="title" value="{{ $todo->title }}">
              </div>
              <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        </form>
    </div>
@endsection