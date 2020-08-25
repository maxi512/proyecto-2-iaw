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
                        @if ($errors->has('addError'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                            @if ($loop->last)
                                            @else
                                                 <li>{{$error}}</li>
                                            @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
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
                            <div class="col-6" id="artists">
                                <select name="artists[]" class="form-control my-1" onchange=" updateSelectAlbumsAdd();">
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}">{{$artist->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm mr-2" 
                                    id="addSelectArtist" onclick="addSelect()">Add Artist</button>
                                <button type="button" class="btn btn-secondary btn-sm" 
                                    id="deleteSelectArtist" onclick="removeSelect()">Remove Artist</button>
                            </div>
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Album:</label>
                    <select name="album" class="form-control my-1" id="albumAddSelect"></select>
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
    $('#modalAddSong').on('hide.bs.modal', function () {
        onHideAddSong()
    })
</script>
@if(($errors->count() > 0) && ($errors->has('addError')) || Session::get('success'))
    <script> onBackFromController(); </script>
@endif