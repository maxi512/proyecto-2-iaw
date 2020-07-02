<div class="modal fade"  id="editAlbum" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Edit artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalAlertEditAlbum">
                    @if(session('successUpdateAlbum'))
                        <div class="alert alert-success">
                            <p>{{ session('successUpdateAlbum') }}</p>
                        </div>
                    @endif
                    @if($errors->has('updateAlbumError'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{$errors->first()}}</li>
                            </ul>
                        </div>
                    @endif
                    @if (session('artistsError'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{session('artistsError')}}</li>
                            </ul>
                        </div>
                    @endif
                </div>
                <form id="formEditAlbum" action="/albums/update" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" id="inputNameAlbum" name="name" class="form-control">
                    </div>
                    <label class="col-form-label">Artists:</label>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div id="artistsDivAlbum"></div>
                            </div>
                                <div class="col-6 d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm mr-2" 
                                    id="addSelectArtistEdit"
                                    data-album="{{$album->id}}" 
                                    onclick="onClickAddArtistButton($(this))">Add Artist</button>

                                <button type="button" class="btn btn-secondary btn-sm" 
                                    id="deleteSelectArtistEdit" 
                                    onclick="deleteSelect();">Remove Artist</button>
                                </div>
                        </div>
                        </div>
                    <input type="hidden" name="album" id="albumHide">

                    <label for="imageInputEdit" class="col-form-label">Image:</label>
                    <input type="file" name="cover" class="form-control-file" id="imageInputEdit" >
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="editAlbumButton" class="btn btn-primary" form="formEditAlbum">Edit</button>
            </div>
        </div>
    </div>
</div>
@if($errors->has('updateAlbumError') || Session::get('successUpdateAlbum') || session('artistsError'))
    <script>setListenersOnBackFromControllerEditAlbum()</script>
@endif