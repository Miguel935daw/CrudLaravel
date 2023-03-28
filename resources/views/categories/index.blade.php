@extends('app')

@section('content')
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categories.store')}}" method="POST">
                @csrf
                @if(session('success'))
                    <h6 class='alert alert-success'>{{ session('success') }}</h6>
                @endif
    
                @error('name')
                    <h6 class='alert alert-danger'>{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoría</label>
                    <input type="color" class="form-control" name="color">
                  </div>
                  <button type="submit" class="btn btn-primary">Crear nueva categoría</button>
            </form>
        </div>
        <div>
            @foreach ($categories as $category)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a class="d-flex align-items-center gap2" href="{{ route('categorias-show', ["category" => $category->id]) }}">
                        <span class="color-container " style="background-color: {{ $category->color }};margin-right: 5px;"></span> {{ $category->name }}</a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-delete" categoryid="{{$category->id}}">
                            Eliminar
                          </button>
                    </div>
                </div>
            @endforeach
            <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Quieres eliminar la categoría?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Junto con ella se eliminaran las tareas que pertenezcan a la misma
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form action="{{ route('categorias-destroy', ['category' => 'categoryid']) }}" method="POST" id="modalForm">
                      @method('DELETE')
                      @csrf
                      <input type="hidden" name="category_id" id="category-id-input">
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
            <script>
              var hiddenInput = document.getElementById('category-id-input')
              var modal = document.getElementById('modalForm')
              document.querySelectorAll('[categoryid]').forEach(element => {
                element.addEventListener('click',($element)=>{
                  hiddenInput.value = element.getAttribute("categoryid")
                  modal.action = modal.action.replace("categoryid", hiddenInput.value)
                })
              });
            </script>
        </div>
    </div>
@endsection