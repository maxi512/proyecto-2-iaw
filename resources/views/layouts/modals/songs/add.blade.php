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

                    <label for="recipient-name" class="col-form-label">Youtube Link:</label>
                    <input type="text" name="youtube_link" class="form-control">
                    
                    <label for="recipient-name" class="col-form-label">Duration:</label>
                    <input type="text" name="duration" class="form-control">

                    <label for="artists" class="col-form-label">Artists:</label>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <select name="artists[]" class="form-control my-1">
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}">{{$artist->name}}</option>
                                    @endforeach
                                </select>
                                <div id="artists"></div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm mr-2" id="addSelectArtist">Add Artist</button>
                                <button type="button" class="btn btn-secondary btn-sm" id="deleteSelectArtist">Remove Artist</button>
                            </div>
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Album:</label>
                    <select name="album" class="form-control my-1">
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                    </select>
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
        $('#addSongModalAlert').addClass('d-none');
    })
</script>
<script>
    $('#addSelectArtist').on('click', function(){
        var url = '/artists/all';
        $.get(url, function(data) {
            var artistsDiv = $('#artists');

            artistsDiv.append(' <select name="artists[]" class="form-control my-2"></select>')

            $.each(data, function(key, value) {
                $('#artists select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });    
    });

    $('#deleteSelectArtist').on('click', function(){
             $('#artists select:last-child').remove();
    });
</script>
@if(!empty(Session::get('errors')) > 0 || Session::get('success'))
    <script>
        $(function() {
            $('#modalAddSong').modal('show');
        });
    </script>
@endif