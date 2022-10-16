<?php

namespace App\Http\Controllers;

use App\Models\elliott;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElliottController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['alumnos']=elliott::paginate(1);
        return view('alumno.index',$datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100', 
            'ApellidoMaterno'=>'required|string|max:100', 
            'Correo'=>'required|email', 
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',  

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);


        //$datosAlumno= request()->all();
        $datosAlumno= request()->except('_token');

        if($request->hasFile('Foto')){

            $datosAlumno['Foto']=$request->file('Foto')->store('uploads','public');

        }

        elliott::insert($datosAlumno);

        //return response()->json($datosAlumno); 
        return redirect('alumno')->with('mensaje','Alumno agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\elliott  $elliott
     * @return \Illuminate\Http\Response
     */
    public function show(elliott $elliott)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\elliott  $elliott
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $alumno=elliott::findOrFail($id);
        return view('alumno.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\elliott  $elliott
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100', 
            'ApellidoMaterno'=>'required|string|max:100', 
            'Correo'=>'required|email', 
             

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',]; 
            $mensaje=['required'=>'El :attribute es requerido','Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);



        //
        $datosAlumno= request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $alumno=elliott::findOrFail($id);
            Storage::delete('public/'.$alumno->Foto);
            $datosAlumno['Foto']=$request->file('Foto')->store('uploads','public');
        }

        elliott::where('id','=',$id)->update($datosAlumno);
        $alumno=elliott::findOrFail($id);
        //return view('alumno.edit', compact('alumno'));

        return redirect('alumno')->with('mensaje','Alumno modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\elliott  $elliott
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $alumno=elliott::findOrFail($id);

        if(Storage::delete('public/'.$alumno->Foto)){
            elliott::destroy($id);
        }

        return redirect('alumno')->with('mensaje','Alumno borrado');
    }
}
