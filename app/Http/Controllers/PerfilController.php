<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' ,['except'=>'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $usuario=$perfil->user_id;
        $userRecetas=Receta::where('user_id', $usuario)->paginate(3);
        return view('perfiles.show')->with('perfil',$perfil) 
                                    ->with('userRecetas', $userRecetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Policy
        $this->authorize('view', $perfil);
        return view('perfiles.edit')->with('perfil',$perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //´Policy
        $this->authorize('update', $perfil);
        
        //dd($request['imagen']);
         //Validar
         
         $data=request()->validate([
            'nombre'=> 'required',            
            'biografia'=> 'required'
          ]);

          //Verficar si el usuario sube una imagen
          if($request['imagen']){
            $ruta_imagen=($request['imagen']->store('upload-perfiles','public'));
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(500,500);
            $img->save();

            //Arreglo de imagenes
            $array_image=['imagen'=>$ruta_imagen];
          }

         //dd($data); Verficamos informacion enviada desde el el html
          //Actualizar tabla users
          auth()->user()->name=$data['nombre'];
          auth()->user()->save();

          //Eliminar name de data
           unset($data['nombre']);

           

          //Guardar informacion tabla perfils
          auth()->user()->userPerfil()->update(
            array_merge(//dos parametros de tipo array
                $data,
                $array_image ?? [] // Almacenando la imagen
            )
              
          );
        
         //Redireccionar
         return redirect()->action([RecetaController::class, 'index']);
    }

   
}
