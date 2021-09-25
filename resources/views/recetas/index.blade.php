@extends('layouts.app')

  @section('botones')
    @include('ui.navegacion')
  @endsection  
   
  @section('content')
  <h2 class="text-center mb-3">Administra tus Recetas</h2>

    
  <div class="cold-md-10 mx-auto bg-white p-3">
    <table class="table">
    
          <thead class="bg-primary text-light">

            <tr>
                <th scole="col">Nombre</td>
                <th scole="col">Categoria</td>
                <th scole="col">Acciones</td>
            
            </tr>
                    
          </thead>

          <tbody>

           @foreach($userRecetas as $userReceta)

               <tr>
                  <td>{{$userReceta->nombre}}</td>
                  <td>{{$userReceta->categoriaReceta->nombre}}</td>
                  <td>
                    <a href="{{route('recetas.show',['receta'=>$userReceta->id])}}" class="btn btn-success d-block"> Ver </a>
                    <a href="{{route('recetas.edit',['receta'=>$userReceta->id])}}" class="btn btn-dark  d-block mt-1"> Editar </a>                    
                    <eliminar-receta receta-id={{$userReceta->id}}></eliminar-receta>
                    
                    
                    
                  </td>
              
              </tr>
             
           @endforeach
             
          
          </tbody>
    
    </table>
    <div class="cold-12 mt-4 justify-content-center d-flex">
    
      {{$userRecetas->links()}}
    </div>
   {{--}} {{Auth::user()->ilike}} --}}

    {{--{{$ilikes}} --}}
    @if(count($iLikes)>0)          
      <h2 class="text-center my-5">Recetas que te gustan</h2>
      <div class="col-md-10 mx-auto bg-white p-3">
            <ul class="list-group">
                @foreach($iLikes as $recetaLike)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{$recetaLike->nombre}}</p>
                    <a class ="btn btn-info " href="{{route('recetas.show',['receta'=>$recetaLike->id])}}">
                    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    Ver</a>
                  </li>
                @endforeach
            </ul>
      </div>

    @else
      <p class="text-center my-5 font-weight-bold"> Aun no tienes Recetas que te gustan</p>
    @endif
 </div>
 

@endsection  