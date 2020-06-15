@extends('layouts.app')
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
                <th scope="col">
					<div class="d-flex">
						<div>Album</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($songs as $song)
				<tr>
					<th scope="row">{{ $song->id }}</th>
					<td>{{ $song->name }}</td>
					<td>
						<div class="row">
							<div class="col">
								<a>
									@foreach($song->artists as $artist)
										@if($loop->last)
											{{ $artist->name }}.
										@else
											{{ $artist->name }},
										@endif
									@endforeach
								<a/>
							</div>
						</div>
                    </td>
                    <td>
                        {{$song->album->name}}
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
		$(document).ready(function() {$('#example').DataTable({"pageLength": 10,
		"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">'
		});});
	</script>
@endsection