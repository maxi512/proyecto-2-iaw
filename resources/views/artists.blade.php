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
			</tr>
			</tr>
		</thead>
		<tbody>
			@foreach ($artists as $artist)
				<tr>
					<th scope="row">{{ $artist->id }}</th>
					<td>{{ $artist->name }}</td>
					<td>{{$artist->country}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Artist </button>

	@include('layouts.artist_modal')
	<script>
		$(document).ready(function() {$('#example1').DataTable({"pageLength": 10,"dom": '<"d-flex justify-content-end"f>t<"d-flex justify-content-center"p><"clear">'});});
	</script>
@endsection