@extends('layouts.master')
@section('content')
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
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
						<button type="button" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#editModal" data-country="{{$artist->country}}" data-name="{{$artist->name}}" data-id="{{$artist->id}}">Edit</button>
						<button type="button" class="btn btn-danger btn-sm edit" data-toggle="modal" data-target="#deleteModal" data-name="{{$artist->name}}" data-id="{{$artist->id}}">Delete</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Artist</button>
	@include('layouts.edit_artist_modal')
	@include('layouts.artist_delete_modal')
	@include('layouts.artist_modal')
	<script>
		$(document).ready(function() {
			$('#example1').DataTable({"pageLength": 10,
			"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">',
		});});
	</script>
@endsection