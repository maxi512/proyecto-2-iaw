<div class="modal fade"  id="modalAddSong" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="addSongModalAlert">
                    @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <p>Data added!</p>
                            </div>
                        @endif
                </div>
                <form id="formSong" action="/songs/submit" method="POST"> 
                     {{ csrf_field() }}
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" name="name" class="form-control" id="recipient-name">

                    <label for="selectArtist" class="col-form-label">Artist:</label>
                    <select name="artist" class="form-control" id="selectArtist">
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>

                    <label for="selectAlbum" class="col-form-label">Album:</label>
                    <select name="album" class="form-control sr-only" id="selectAlbum"></select>

                    <label for="recipient-name" class="col-form-label">Youtube Link:</label>
                    <input type="text" name="youtube_link" class="form-control">
                    
                    <label for="recipient-name" class="col-form-label">Duration:</label>
                    <input type="text" name="duration" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formSong">Add</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalAddSong').on('hide.bs.modal', function (e) {
        $('#selectAlbum').addClass('sr-only');
        $("#selectArtist").prop("selectedIndex", 0);
        $('#modalAddSong').on('hidden.bs.modal', function () {
        $('#addSongModalAlert').addClass('d-none');
    });
    })
</script>
<script>
    $(function() {
        $('#selectArtist').change(function() {
            $('#selectAlbum').removeClass('sr-only');
            var url = '{{ url('artists') }}/' + $(this).val() + '/albums/';
            $.get(url, function(data) {
                var select = $('#selectAlbum');
                select.empty();
                $.each(data, function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        });
    });
</script>
@if(!empty(Session::get('errors')) > 0 || Session::get('success'))
    <script>
        $(function() {
            $('#modalAddSong').modal('show');
        });
    </script>
@endif