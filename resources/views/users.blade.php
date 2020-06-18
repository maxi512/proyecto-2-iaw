@extends('layouts.app')
@section('content')
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
	<table class="table table-striped table-bordered" id="usersTable" style="width:100%">
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
						<div>Email</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
                </th>
                <th scope="col">
					<div class="d-flex">
						<div>Role</div>
						<div class="ml-auto"><i class="fas fa-sort" aria-hidden="true"></i></div>
					</div>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
                    <td>{{ $user->roles->first()->name }}</td>
					<td>
						@can('update users')
							<button type="button" class="btn btn-primary btn-sm edit" 
								data-toggle="modal" data-target="#editUserModal"
								data-name="{{ $user->name }}" data-id="{{ $user->id }}"
								data-role="{{ $user->roles->first()->id }}">Edit
							</button>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@include('layouts.modals.users.edit')
	<script>
		$(document).ready(function() {
			$('#usersTable').DataTable({"pageLength": 10,
			"dom": '<"d-flex row justify-content-center"<"col"><"col-4 d-flex justify-content-center align-self-end"text-center"p><"col p-2 mr-2"<"float-right"f>>>t<"clear">',
		});});
	</script>
@endsection