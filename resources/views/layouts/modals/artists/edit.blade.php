<div class="modal fade"  id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Edit artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalAlertEditArtist">
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
                <form id="formEditArtist" action="/artists/update" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" id="inputName" name="name" class="form-control">
                    </div>
                    <label for="recipient-name" class="col-form-label">Country:</label>
                    <select name="country" id="select" class="form-control">
                        @foreach($countries as $country)
                            <option value="{{ $country}}">{{ $country}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id" id="artistHide">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="editButton" class="btn btn-primary" form="formEditArtist">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit').on('click', function() {
        $('#select').val($(this).data('country'))
        $('#inputName').val($(this).data('name'))
        $('#artistHide').val($(this).data('id'))
    });
</script>
@if(session('status') || $errors->first() == 'No changes detected.')
     <script>
        $(function() {
            $('#editModal').modal('show');
            $('#formEditArtist').addClass('d-none');
            $('#editButton').addClass('d-none');
        });
        $('#editModal').on('hidden.bs.modal', function () {
            $('#modalAlertEditArtist').addClass('d-none');
            $('#formEditArtist').removeClass('d-none');
            $('#editButton').removeClass('d-none');
        });
    </script>
@endif