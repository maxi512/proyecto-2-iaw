@extends('layouts.app')
@section('content')
	<script src="/js/albums/coverAlbum.js"></script>
	<script src="/js/albums/addAlbum.js"></script>
	<script src="/js/albums/deleteAlbum.js"></script>
	<table class="table table-striped table-bordered" id="tableAlbums" style="width:100%">
		<thead>
			<tr>
				<th scope="col">
					<div class="d-flex">
						<div>Id</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				<th scope="col">
					<div class="d-flex">
						<div>Name</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				
				<th scope="col">
					<div class="d-flex">
						<div>Artists</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($albums as $album)
				<tr>
					<th scope="row">{{ $album->id }}</th>
					<td>{{ $album->name }}</td>
					<td>
						<div class="row">
							<div class="col">
								<a>
									@foreach($album->artists as $artist)
										@if($loop->last)
											{{ $artist->name }}.
										@else
											{{ $artist->name }},
										@endif
									@endforeach
								</a>
							</div>
							<div class="col">
								
							</div>
						</div>
					</td>
					<td class="text-center">
						<button type="button" class="btn btn-primary btn-sm" 
								data-toggle="modal" data-target="#modalCover" 
								data-id="{{ $album->id }}" onclick="showCover($(this))">
							Cover
						</button>

						<a href="/albums/show/{{ $album->id }}" >
							<button class="btn btn-info btn-sm" class="text-white">Details</button>
						</a>

						@can('delete albums')
							<button type="button" class="btn btn-danger btn-sm delete" 
								data-toggle="modal" data-target="#deleteAlbumModal" 
								data-name="{{$album->name}}" data-id="{{$album->id}}"
								onclick="deleteAlbum($(this))">Delete</button>
						@endcan
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	@can('update albums')
		<button type="button" class="btn btn-success" 
		data-toggle="modal" data-target="#modalAddAlbum">Add Album</button>
	@endcan

	@include('layouts.modals.albums.cover')
	@include('layouts.modals.albums.add')
	@include('layouts.modals.albums.delete')

	<script>
		$(document).ready(function() {$('#tableAlbums').DataTable({
			"pageLength": 10,
			"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">',
		});});
	</script>
@endsection