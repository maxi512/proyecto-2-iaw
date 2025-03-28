@extends('layouts.app')
@section('content')
	<script src="/js/songs/addSong.js"></script>
	<script src="/js/songs/editSong.js"></script>
	<script src="/js/songs/deleteSong.js"></script>

	<table class="table table-striped table-bordered" id="songsTable" style="width:100%">
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
				<th>
					<div class="d-flex">
						<div>Duration</div>
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
					<td><a href="{{$song->youtube_link}}">{{ $song->name }}</a></td>
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
                    <td>{{ $song->album->name }}</td>
					<td>{{ $song->duration }}</td>
					<td class="text-center">
						@can('update songs')
							<button type="button" class="btn btn-primary btn-sm edit" 
								data-toggle="modal" data-target="#editSongModal" 
								data-album="{{$song->album->id}}"
								data-link="{{$song->youtube_link}}"
								data-duration="{{$song->duration}}"
								data-name="{{$song->name}}" data-id="{{$song->id}}"
								onclick="onClickEditSongButton($(this))">Edit
							</button>	
						@endcan
						@can('delete songs')
							<button type="button" class="btn btn-danger btn-sm delete"
									data-toggle="modal" 
									data-name="{{$song->name}}" data-id="{{$song->id}}" 
									data-target="#deleteSongModal" onclick="deleteSong($(this))">Delete
							</button>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<button type="button" class="btn btn-success"
		data-toggle="modal" data-target="#modalAddSong"
		onclick="updateSelectAlbumsAdd()">Add Song</button>

	@include('layouts.modals.songs.add')
	@include('layouts.modals.songs.edit')
	@include('layouts.modals.songs.delete')
	
    <script>
		$(document).ready(function() {$('#songsTable').DataTable({"pageLength": 10,
		"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">'
		});});
	</script>
@endsection