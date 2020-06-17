<div class="modal fade"  id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="modalAlertEditUser">
                    @if(session('status'))
                        <div class="alert alert-success">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{$errors->first()}}</li>
                            </ul>
                        </div>
                    @endif
                </div>

                <form id="formEditUser" action="/users/update" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="userNameEdit" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="userNameEdit">

                        <label for="selectEditUser" class="col-form-label">Role:</label>
                        <select name="role" class="form-control" id="selectEditUser">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id" id="userIdEdit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="editButton" class="btn btn-primary" form="formEditUser">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit').on('click', function() {
        $('#userNameEdit').val($(this).data('name'))
        $('#userIdEdit').val($(this).data('id'))
        $('#selectEditUser').val($(this).data('role'))
        });
</script>
@if(session('status') || $errors->first() == 'No changes detected.')
     <script>
        $(function() {
            $('#editUserModal').modal('show');
            $('#formEditUser').addClass('d-none');
            $('#editButton').addClass('d-none');
        });
        $('#editUserModal').on('hidden.bs.modal', function () {
            $('#modalAlertEditUser').addClass('d-none');
            $('#formEditUser').removeClass('d-none');
            $('#editButton').removeClass('d-none');
        });
    </script>
@endif