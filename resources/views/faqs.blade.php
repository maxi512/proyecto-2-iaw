@extends('layouts.app')
@section('content')
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cuales son los pasos a seguir para agregar un album?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    	<div class="card-body">
			<ul>
				<li>Ir al apartado "<b>Albums</b>"</li>
				<li>Hacer click en "<b>Add Song</b>"</li>
				<li>Rellenar el formulario y hacer click en "<b>Add</b>"</li>
				<li>Si quieres agregarle canciones, busca el album en la tabla y haz click en "<b>Details</b>"</li>
				<li>Por ultimo, haz click en "<b>Add Song</b>"</li>
			</ul>
      	</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Por que no veo el boton "Add"?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Porque no tenes permisos para agregar elementos :( srry
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Que restricciones se tienen en cuenta a la hora de agregar albums o canciones?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Se tomo la siguiente convencion: TODOS los artistas de una cancion deben estar entre los artistas del album.
      </div>
    </div>
  </div>
</div>
@endsection