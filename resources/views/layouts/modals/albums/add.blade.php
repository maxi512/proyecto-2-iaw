<div class="modal fade"  id="modalAddAlbum" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Add new album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalAlert">
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
                <form id="formArtist" action="/albums/submit" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group" id="group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="recipient-name">
                    
                        <label for="imageInput" class="col-form-label">Image:</label>
                        <input type="file" name="cover" class="form-control-file" id="imageInput" >
                        <label for="artists" class="col-form-label">Artists:</label>
                        <div class="container" id="artists"></div>
                    </div> 
                </form>
                <button class="btn btn-success btn-sm" id="addSelectArtist">Add Artist</button>
                <button class="btn btn-secondary btn-sm" id="deleteSelectArtist">Remove Artist</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formArtist">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#addSelectArtist').on('click', function(){
        var url = '/artists/all';
        $.get(url, function(data) {
            var artistsDiv = $('#artists');

            artistsDiv.append(' <select name="artists[]" class="form-control my-1"></select>')

            $.each(data, function(key, value) {
                $('#artists select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });    
    });

    $('#deleteSelectArtist').on('click', function(){
             $('#artists select:last-child').remove();
    });
</script>

@if((!empty(Session::get('errors')) > 0 && !($errors->first() == 'No changes detected.'))|| Session::get('success'))
    <script>
        $(function() {
            $('#modalAddAlbum').modal('show');
        });
        $('#modalAddAlbum').on('hidden.bs.modal', function () {
            $('#modalAlert').addClass('d-none');
        });
    </script>
@endif