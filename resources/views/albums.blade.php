@extends('layouts.master')
@section('content')
  <table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Artists</th>
		</tr>
    </thead>
    <tbody>
		@foreach ($albums as $album)
		<tr>
			<th scope="row">{{ $album->id }}</th>
			<td>{{ $album->name }}</td>
			<td>
				<select name="categories" id="categories" class="form-control">
					@foreach($album->artists as $artist)
						<option value="{{ $artist->id }}">{{ $artist->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		@endforeach
    </tbody>
  </table>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Artist </button>
  @include('layouts.artist_modal')
@endsection