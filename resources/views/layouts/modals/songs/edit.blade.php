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
                        @if ($errors->has('updateError'))
                            <div class="alert alert-danger">
                                <ul> @foreach ($errors->all() as $error)
                                        @if ($loop->last)
                                        @else
                                            <li>{{$error}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>
                <form id="formEditSong" action="/songs/update" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="songNameEdit" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="songNameEdit">

                        <label class="col-form-label">Artist:</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div id="artistsDiv"></div>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-sm mr-2" 
                                        id="addSelectArtistEdit" 
                                        onclick="onClickAddArtistButton()">Add Artist</button>

                                    <button type="button" class="btn btn-secondary btn-sm" 
                                        id="deleteSelectArtistEdit" 
                                        onclick="deleteSelect();">Remove Artist</button>
                                </div>
                            </div>
                        </div>

                        <label for="albumSelect" class="col-form-label">Album:</label>
                        <select name="album" class="form-control my-1" id="albumSelect"></select>

                        <label for="youtubeLinkEdit" class="col-form-label">Youtube Link:</label>
                        <input type="text" name="youtube_link" class="form-control" id="youtubeLinkEdit">

                        <label for="durationEdit" class="col-form-label">Duration:</label>
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

<script> setListeners() </script>

@if(session('status') || $errors->has('updateError'))
    <script> setListenersOnBackFromController() </script>
@endif