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

     <h1 class="text-center">EDITAR PERFIL</h1>
     <div class="row justify-content-center mt-5">
            <div class="col-md-10 bg-white p-3">
                <form method="POST" action="{{route('perfiles.update', ['perfil'=>$perfil->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control @error('nombre')  is-invalid @enderror "            
                            placeholder="Nombre" id="nombre" placeholder="Nombre Helado" value="{{$perfil->perfilUser->name}}">                               
                            <!--Validad Error  -->
                            @error('nombre')

                                    <span class="invalid-feeback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                
                            @enderror
                        </div>

                           <!--Biografia -->
                          <div class="form-group mt-4">
                            <label for="biografia">Biografia</label>
                            <input id="biografia" type="hidden" name="biografia"  value="{{$perfil->biografia}}">    
                            <trix-editor  class="form-control @error('biografia')  is-invalid @enderror" 
                            input="biografia"></trix-editor>

                           <!--Validad Error  -->
                                @error('ingredientes')

                                        <span class="invalid-feeback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    
                                @enderror
                          </div>  

                           <!--Imagen -->
                         <div class="form-group mt-4 ">
                            <label for="imagen">Imagen </label>
                            <input id="imagen" type="file" class="form-control @error('preparacion')  is-invalid @enderror" name="imagen" > 
                                @if($perfil->imagen !=null)
                                   <div class="mt-4 ">                                
                                        <p >Imagen Actual</p>
                                        <img src="/storage/{{$perfil->imagen}}"  style="width: 300px">                                
                                   </div> 
                                @endif
                                
                             <!--Validad Error  -->
                                @error('imagen')

                                        <span class="invalid-feeback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    
                                @enderror 
                            
                           </div>  

                           <div class="form-group mt-3 row justify-content-center" >
                                <input type="submit" class="btn btn-primary" value="Editar Perfil">
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