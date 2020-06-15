<div class="modal fade"  id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Delete artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                     <p>Are you sure to delete to <b id="artistName"></b>?</p>
                </div>
                <div id="modalAlertDeleteArtist">
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
                <form id="formDeleteArtist" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="artistHideDelete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="deleteButton" class="btn btn-danger" form="formDeleteArtist">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit').on('click', function() {
    $('#artistHideDelete').val($(this).data('id'))
    $('#artistName').html($(this).data('name'))
    $('#formDeleteArtist').attr('action','/artists/delete/'.concat($(this).data('id')))
    console.log($('#formDeleteArtist').attr('action'));
    });
</script>
@if(session('status') || $errors->first() == 'No changes detected.')
     <script>
        $(function() {
            $('deleteModal').modal('show');
            $('#formEditArtist').addClass('d-none');
            $('#deleteButton').addClass('d-none');
        });
        $('#editModal').on('hidden.bs.modal', function () {
            $('#modalAlertEditArtist').addClass('d-none');
            $('#formEditArtist').removeClass('d-none');
            $('#editButton').removeClass('d-none');
        });
    </script>
@endif