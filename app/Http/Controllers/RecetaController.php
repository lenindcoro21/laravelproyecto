<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    // constructor para progteger las url
        public function __construct()
        {
            $this->middleware('auth', ['except'=>'show']);
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $usuario=Auth::user();
        $usuario=Auth::user()->id;
        $userRecetas=Receta::where('user_id' ,$usuario)->paginate(2);
        //$userRecetas=Auth::user()->userRecetas;

        //Recetas que le gusta el usuario
        $iLikes=Auth::user()->ilike;
        return view('recetas.index')->with('userRecetas',$userRecetas)
                                     ->with('iLikes', $iLikes);
                                   //  ->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //SIN MODELO
        //$categorias=DB::table('categorias_recetas')->get()->pluck('nombre','id');

        // CON MODELO

        $categorias=CategoriaReceta::all(['id','nombre']);
        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
       //validacion
        $data=$request->validate([

            'nombre'=>'required|min:6',
            'categoria'=>'required',
            'ingredientes'=>'required',
            'preparacion'=>'required',
            'imagen'=>'required|image'

        ]);

        //
        $ruta_imagen=($request['imagen']->store('upload-recetas','public'));
        $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
        $img->save();

         // Insertar sin Modelo
       /* DB::table('recetas')->insert([
            'nombre'=>$data['nombre'], 
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen'=>$ruta_imagen,
            'user_id'=>Auth::user()->id, 
            'categoria_id'=>$data['categoria'],

        ]);*/

        // Insertar con Modelo

        Auth::user()->userRecetas()->create([

            'nombre'=>$data['nombre'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen'=>$ruta_imagen,
            'categoria_id'=>$data['categoria'],

        ]);

        //redireccionar
        return redirect()->action( [RecetaController::class, 'index']);
        //dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Si el usuario autentificado ld dio like a la receta
         $like=(Auth::user()) ? Auth::user()->iLike->contains($receta->id) : false;

        //Cantidad de Likes en la receta Actual 
        $likes=$receta->likes()->count();
        return view('recetas.show')->with('receta',$receta)
                                   ->with('like',$like)
                                   ->with('likes',$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Verificacion del policy
        $this->authorize('view', $receta );
        $categorias=CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit')->with('categorias',$categorias)
                                   ->with('receta', $receta);

    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //Verificacion del policy

        $this->authorize('update', $receta );        
        $data=$request->validate([

            'nombre'=>'required|min:6',
            'categoria'=>'required',
            'ingredientes'=>'required',
            'preparacion'=>'required',
            

        ]);

         //Asignar valores 
         $receta->nombre=$data['nombre'];
         $receta->categoria_id=$data['categoria'];
         $receta->ingredientes=$data['ingredientes'];
         $receta->preparacion=$data['preparacion'];

          //Nueva imagen

          if(request('imagen')){
            // Guardar la imagen en nuestro store
            $ruta_imagen=$request['imagen']->store('upload-recetas','public');
            //Despues aplicamos el estilo
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
            $img->save();
            $receta->imagen=$ruta_imagen; 

        }

         // Guardar informacion
         $receta->save(); 

         //redieccionar 
         return redirect()->action([RecetaController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Verificacion del policy

        $this->authorize('delete', $receta );
        //return "desde el eliminar";

        //Agregar Metodo Eliminar
        $receta->delete();
        return redirect()->action([RecetaController::class, 'index']);
    }
}
