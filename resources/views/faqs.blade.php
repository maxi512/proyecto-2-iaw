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
				<li>Por último, haz click en "<b>Add Song</b>"</li>
			</ul>
      	</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cuáles son los pasos a seguir para agregar un artista?
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    	<div class="card-body">
			<ul>
				<li>Ir al apartado "<b>Artists</b>"</li>
				<li>Hacer click en "<b>Add Song</b>"</li>
				<li>Rellenar el formulario y hacer click en "<b>Add</b>"</li>
			</ul>
      	</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Por qué no veo el boton "Add"?
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
          Qué restricciones se tienen en cuenta a la hora de agregar albums o canciones?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Se tomo la siguiente convencion: <b>TODOS</b> los artistas de una cancion deben estar entre los artistas del album.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Sí borro un artista, qué pasa con sus canciones?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Si alguna de las canciones que estaban asociadas a este artista queda sin ningun artista asociado, se eliminara en el momemto que se elimina dicho artista.      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Si borro un artista, qué pasa con sus albums?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        De mismo modo que las canciones, si el album queda sin otro artista, sera borrado en el momento que se borra dicho artista.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Qué significa el mensaje "You have some songs that dont match these artists" a la hora de editar un album?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Significa que se quiso editar un albúm, cambiando alguno de los artistas que esta asociado a alguna de las canciones de dicho albúm.  
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Qué significa el mensaje "You have put some artists that dont match with the albums artists" a la hora de editar una canción?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Significa que se quiso editar una cancion, cambiando alguno de sus artistas, los cuales no coinciden con los artistas del album asociado a dicha cancion.  
      </div>
    </div>
  </div>
</div>
@endsection