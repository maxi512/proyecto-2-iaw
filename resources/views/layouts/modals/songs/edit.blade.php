<div class="modal fade"  id="editSongModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Edit song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalAlertEditSong">
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

                <form id="formEditSong" action="/songs/update" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="songNameEdit" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="songNameEdit">

                        <label for="selectEditArtist" class="col-form-label">Artist:</label>
                        <select name="artist" class="form-control" id="selectEditArtist">
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <label for="selectEditAlbum" class="col-form-label">Album:</label>
                        <select name="album" class="form-control sr-only" id="selectEditAlbum"></select>

                        <label for="youtubeLinkEdit" class="col-form-label">Youtube Link:</label>
                        <input type="text" name="youtube_link" class="form-control" id="youtubeLinkEdit">

                        <label for="durationLinkEdit" class="col-form-label">Duration:</label>
                        <input type="text" name="duration" class="form-control" id="durationEdit">

                    </div>
                    <input type="hidden" name="id" id="songId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="editButton" class="btn btn-primary" form="formEditSong">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit').on('click', function() {
        $('#songNameEdit').val($(this).data('name'))
        $('#selectEditArtist').val($(this).data('artist'))
        $('#youtubeLinkEdit').val($(this).data('link'))
        $('#durationEdit').val($(this).data('duration'))
        $('#songId').val($(this).data('id'))

        var url = '{{ url('artists') }}/' + $(this).data('artist') + '/albums';
        $('#selectEditAlbum').removeClass('sr-only');
        console.log(url)
        $.get(url, function(data) {
            var select = $('#selectEditAlbum');
            select.empty();
            $.each(data, function(key, value) {
                select.append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
        });
</script>
<script>
    $(function() {
        $('#selectEditArtist').change(function() {
            $('#selectEditAlbum').removeClass('sr-only');
            var url = '{{ url('artists') }}/' + $(this).val() + '/albums/';
            $.get(url, function(data) {
                var select = $('#selectEditAlbum');
                select.empty();
                $.each(data, function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        });
    });
</script>
@if(session('status') || $errors->first() == 'No changes detected.')
     <script>
        $(function() {
            $('#editSongModal').modal('show');
            $('#formEditSong').addClass('d-none');
            $('#editButton').addClass('d-none');
        });
        $('#editSongModal').on('hidden.bs.modal', function () {
            $('#modalAlertEditSong').addClass('d-none');
            $('#formEditSong').removeClass('d-none');
            $('#editButton').removeClass('d-none');
        });
    </script>
@endif