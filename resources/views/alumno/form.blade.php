
<h1> {{ $modo }} alumno </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
    <ul>
        @foreach( $errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
    </div>


@endif


<div class="form-group">

<label for="Nombre"> Nombre </label>
<input type="text" class="form-control" name="Nombre" 
value="{{ isset($alumno->Nombre)?$alumno->Nombre:old('Nombre') }}" id="Nombre">
<br>
</div>


<div class="form-group">

<label for="ApellidoPaterno"> ApellidoPaterno </label>
<input type="text" class="form-control" name="ApellidoPaterno" 
value="{{ isset($alumno->ApellidoPaterno)?$alumno->ApellidoPaterno:old('ApellidoPaterno') }}"  id="ApellidoPaterno">
<br>
</div>

<div class="form-group">

<label for="ApellidoMaterno"> ApellidoMaterno </label>
<input type="text" class="form-control" name="ApellidoMaterno" 
value="{{ isset($alumno->ApellidoMaterno)?$alumno->ApellidoMaterno:old('ApellidoMaterno') }}"  id="ApellidoMaterno">
<br>
</div>

<div class="form-group">

<label for="Correo"> Correo </label>
<input type="text" class="form-control" name="Correo" 
value="{{ isset($alumno->Correo)?$alumno->Correo:old('Correo') }}"  id="Correo">
<br>
</div>

<div class="form-group">

<label for="Foto"></label>
@if(isset($alumno->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$alumno->Foto }}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">

<br>

</div>

<input class="btn btn success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('alumno/') }}"> Regresar </a>

<br>