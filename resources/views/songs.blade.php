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
				<th></th>
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
					<td>
						@can('update songs')
							<button type="button" class="btn btn-primary btn-sm edit" 
								data-toggle="modal" data-target="#editSongModal" 
								data-album="{{$song->album->id}}"
								data-link="{{$song->youtube_link}}"
								data-duration="{{$song->duration}}"
								data-artist="{{$song->artists()->first()->id}}"  
								data-name="{{$song->name}}" data-id="{{$song->id}}">Edit
							</button>	
						@endcan

						@can('delete songs')
							<button type="button" class="btn btn-danger btn-sm delete"
									data-toggle="modal" 
									data-name="{{$song->name}}" data-id="{{$song->id}}" 
									data-target="#deleteSongModal">Delete
							</button>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#modalSong">Add Song</button>
	@include('layouts.song_add_modal')
	@include('layouts.song_edit_modal')
	@include('layouts.song_delete_modal')
    <script>
		$(document).ready(function() {$('#example').DataTable({"pageLength": 10,
		"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">'
		});});
	</script>
@endsection