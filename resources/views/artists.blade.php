@extends('layouts.app')
@section('content')
	<script src="/js/artists/addArtist.js"></script>
	<script src="/js/artists/editArtist.js"></script>
	<script src="/js/artists/deleteArtist.js"></script>
    <table class="table table-striped table-bordered" id="example1" style="width:100%">
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
						<div>Country</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($artists as $artist)
				<tr>
					<th scope="row">{{ $artist->id }}</th>
					<td>{{ $artist->name }}</td>
					<td>{{$artist->country}}</td>
					<td> 
						@can('update artists')
							<button type="button" class="btn btn-primary btn-sm edit" 
									data-toggle="modal" data-target="#editModal" 
									data-country="{{$artist->country}}" 
									data-name="{{$artist->name}}" data-id="{{$artist->id}}"
									onclick="editArtist($(this))">Edit
							</button>
						@endcan
						@can('delete artists')
							<button type="button" class="btn btn-danger btn-sm delete" 
								data-toggle="modal" data-target="#deleteModal" 
								data-name="{{$artist->name}}" data-id="{{$artist->id}}"
								onclick="deleteArtist($(this))">Delete</button>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	@can('update artists')
		<button type="button" class="btn btn-primary" 
		data-toggle="modal" data-target="#myModal">Add Artist</button>
	@endcan

	@include('layouts.modals.artists.add')
	@include('layouts.modals.artists.edit')
	@include('layouts.modals.artists.delete')

	<script>
		$(document).ready(function() {
			$('#example1').DataTable({"pageLength": 10,
			"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">',
		});});
	</script>
@endsection