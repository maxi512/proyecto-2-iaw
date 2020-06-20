<div class="modal fade"  id="deleteSongModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Delete song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="alert alert-warning" role="alert">
                        <p>Are you sure to delete to <b id="songName"></b>?</p>
                    </div>
                <div id="modalAlertDeleteSong">
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
                <form id="formDeleteSong" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="songHideDelete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="deleteButton" class="btn btn-danger" form="formDeleteSong">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete').on('click', function() {
    $('#songHideDelete').val($(this).data('id'))
    
    $('#songName').html($(this).data('name'))
    $('#formDeleteSong').attr('action','/songs/delete/'.concat($(this).data('id')))
    });
</script>
@if(session('status') || $errors->first() == 'No changes detected.')
     <script>
        $(function() {
            $('deleteSongModal').modal('show');
            $('#deleteButton').addClass('d-none');
        });
        $('#deleteSongModal').on('hidden.bs.modal', function () {
            $('#modalAlertDeleteSong').addClass('d-none');
            $('#editButton').removeClass('d-none');
        });
    </script>
@endif