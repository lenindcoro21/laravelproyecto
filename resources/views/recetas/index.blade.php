@extends('layouts.app')

@section('botones')
    <a class="btn btn-primary" href="{{route('recetas.create')}}">Crear sabor de helado</a>
@endsection

@section('content')
<h2 class="text-center mb-3">Administra tus Helados</h2>

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Nombre</th>
                <th scole="col">Categoria</th>
                <th scole="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

                @foreach($userRecetas as $userReceta)

               <tr>
                  <td>{{$userReceta->nombre}}</td>
                  <td>{{$userReceta->categoriaReceta->nombre}}</td>
                  <td>
                    <a href="{{route('recetas.show',['receta'=>$userReceta->id])}}"  class="btn btn-info "> Ver</a>                     
                    <a href="{{route('recetas.edit',['receta'=>$userReceta->id])}}" class="btn btn-dark"> Editar</a>
                    <a href="" class="btn btn-danger"> Eliminar</a> 
                  
                  </td>
              
              </tr>
             
           @endforeach 

        </tbody>
    </table>
</div>
@endsection