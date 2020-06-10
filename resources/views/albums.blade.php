@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
	<table class="table table-striped table-bordered" id="example" style="width:100%">
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
								<a/>
							</div>
							<div class="col">
								<button type="button" class="btn btn-primary btn-sm showCover" data-toggle="modal" data-target="#modalCover" data-albumcover="/storage/images/{{$album->image_src}}">
									Show Cover
								</button>
							</div>
						</div>
					</td>
				</tr>
			@endforeach
			@include('layouts.album_cover_modal')
			<script>
					$('.showCover').on('click', function() {
					$('#modal-body').html('<img src="' + $(this).data('albumcover') + '"/>')});
			</script>
		</tbody>
	</table>
	<script>
		$(document).ready(function() {$('#example').DataTable({"pageLength": 10,"dom": '<"d-flex justify-content-end"f>t<"d-flex justify-content-center"p><"clear">'});});
	</script>
@endsection