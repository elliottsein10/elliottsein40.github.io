@extends('layouts.app')
@section('content')
<div class="container">



    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>

    </div>
    @endif



</div>

<a href="{{ url('alumno/create') }}" class="btn btn-success" > Registrar nuevo alumno </a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <thbody>
        @foreach( $alumnos as $alumnos )
        <tr>
            <td>{{ $alumnos->id }}</td>

            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$alumnos->Foto }}" width="100" alt="">
            </td>

            <td>{{ $alumnos->Nombre }}</td>
            <td>{{ $alumnos->ApellidoPaterno }}</td>
            <td>{{ $alumnos->ApellidoMaterno }}</td>
            <td>{{ $alumnos->Correo }}</td>
            <td>
               
            <a href="{{ url('/alumno/'.$alumnos->id.'/edit') }}"  class="btn btn-warning">

                Editar  

            </a>
             
            <form action="{{ url('/alumno/'.$alumnos->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" 
            value="Borrar">

            </form>
        
            </td>
        </tr>
        @endforeach
        
    </thbody>

</table>

</div>
@endsection  