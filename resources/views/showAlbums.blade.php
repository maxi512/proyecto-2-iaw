@extends('layouts.app')
@section('content')
<script src="/js/albums/edit/editSong.js"></script>
<script src="/js/albums/edit/editAlbum.js"></script>
<script src="/js/albums/edit/addSong.js"></script>
<script src="/js/songs/deleteSong.js"></script>

<div class="row mb-3">
	<div class="col">
		<img src="data:image/jpg;base64,{{$album->image}}"class="img-thumbnail" height="90" width="90">
	</div>
	<div class="col text-center">
		<h2 class="align-middle">{{ $album->name }}</h2>
		<h3 class="align-middle">By @foreach($album->artists as $artist)
					@if($loop->last)
						{{ $artist->name }}.
					@else
						{{ $artist->name }},
					@endif
				@endforeach
		</h3>
	</div>
	<div class="col text-center">
		@can('update albums')
			<button type="button" class="btn btn-primary btn-sm edit mt-3" 
				data-toggle="modal" data-target="#editAlbum"
				data-album="{{$album->id}}" data-name="{{$album->name}}"
				data-year="{{$album->year}}"
				onclick="setInfoInForm($(this))">Edit Album</button>
		@endcan
		
	</div>
</div>
	<table class="table table-striped table-bordered" id="tableSongs" style="width:100%">
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
						<div>Duration</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				<th style="width:15%"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($album->songs as $song)
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
								</a>
							</div>
						</div>
                    </td>
                    <td>{{ $song->duration }}</td>
                    <td>
						@can('update songs')
							<button type="button" class="btn btn-primary btn-sm edit" 
									data-toggle="modal" data-target="#editSongAlbumModal" 
									data-link="{{$song->youtube_link}}"
									data-album="{{ $album->id}}"
									data-duration="{{$song->duration}}"
									data-name="{{$song->name}}" data-id="{{$song->id}}"
									onclick="setElementsFromButton($(this))">Edit
							</button>
						@endcan

						@can('delete songs')
							<button type="button" class="btn btn-danger btn-sm delete" 
								data-toggle="modal" data-target="#deleteSongModal" 
								data-name="{{$song->name}}" data-id="{{$song->id}}"
								onclick="deleteSong($(this))">Delete</button>
						@endcan
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@include('layouts.modals.songs.delete')
	@include('layouts.modals.albums.editSong')
	@include('layouts.modals.albums.editAlbum')
	@include('layouts.modals.albums.addSong')

	@can('update songs')
		<button type="button" class="btn btn-success" 
			data-toggle="modal" data-target="#modalAddSongEditAlbum"
			data-album="{{$album->id}}" onclick="setAlbumToForm($(this))">Add Song</button>
	@endcan
	

@endsection