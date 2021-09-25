@extends('layouts.app')

 <!--Estilos--> 
 @section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" 
  integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

 @endsection

@section('botones')
    @include('ui.listarecetas')
@endsection

@section('content')
    <h2 class="text-center mb-3">Crear nuevo Helado</h2>
    
    <div class=" mt-5">
        <div class="cold-md-8">
        <form method="POST" action={{route('recetas.store')}} enctype="multipart/form-data" novalidate>

            @csrf  
            <!--este csrf va generar un token  -->
            <div class="form-group">
                <label for="nombre">Nombre Helado</label>
                <input type="text" name="nombre" class="form-control @error('nombre')  is-invalid @enderror "              
                

                id="nombre" placeholder="Nombre Helado" value={{old('nombre')}}>
                    
                <!--Validad Error  -->
                @error('nombre')

                        <span class="invalid-feeback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    
                @enderror
            <div>

                <div class="form-group">
                     <label for="nombre">Categoría</label>
                    <select name="categoria" class="form-control @error('categoria')  is-invalid @enderror" 
                       id="categoria">
                        <option value="" disable selected>--Seleccione--</option>
                        @foreach($categorias as  $categoria)

                            <option value={{$categoria->id}} {{old('categoria')==$categoria->id ? 'selected': ''}}>{{$categoria->nombre}}</option>
                            
                        @endforeach    
                                              
                    </select>

                            <!--Validad Error  -->
                            @error('categoria')

                                    <span class="invalid-feeback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                
                            @enderror
                
                </div>

                        <!--Ingredientes -->
                     <div class="form-group mt-4">
                            <label for="ingredientes">Ingredientes</label>
                            <input id="ingredientes" type="hidden" name="ingredientes"  value={{old('ingredientes')}}>    
                            <trix-editor  class="form-control @error('ingredientes')  is-invalid @enderror" 
                            input="ingredientes"></trix-editor>

                         <!--Validad Error  -->
                                @error('ingredientes')

                                        <span class="invalid-feeback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    
                                @enderror
                     </div>   

                         <!--Preparacion -->
                      <div class="form-group mt-4">
                            <label for="preparacion">Preparacion</label>
                            <input id="preparacion" type="hidden" name="preparacion"  value={{old('preparacion')}}>    
                            <trix-editor class="form-control @error('preparacion')  is-invalid @enderror" 
                            input="preparacion"></trix-editor>
                                <!--Validad Error  -->
                                @error('preparacion')

                                        <span class="invalid-feeback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    
                                @enderror
                            
                       </div>  

                        <!--Imagen -->
                     <div class="form-group mt-4">
                            <label for="imagen">Imagen </label>
                            <input id="imagen" type="file" class="form-control @error('preparacion')  is-invalid @enderror" name="imagen" >   
                             <!--Validad Error  -->
                                @error('imagen')

                                        <span class="invalid-feeback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    
                                @enderror 
                            
                     </div>    

                    <div class="form-group mt-3 row justify-content-center" >
                        <input type="submit" class="btn btn-primary" value="Agregar Helado">
                    <div>



        </form>
        </div>
    </div>
@endsection

<!--Scrip--> 
 @section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
  integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

 @endsection 
