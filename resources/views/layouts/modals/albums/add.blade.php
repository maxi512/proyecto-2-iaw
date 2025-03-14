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
                                    @if ($loop->last)
                                    @else
                                        <li>{{$error}}</li>
                                    @endif
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

                        <label for="recipient-year" class="col-form-label">Year:</label>
                        <input type="number" min="1900" max="2020" step="1" 
                            name="year" class="form-control" id="recipient-year">
                    
                        <label for="imageInput" class="col-form-label">Image:</label>
                        <input type="file" name="cover" class="form-control-file" id="imageInput" >
                        
                        <label for="artists" class="col-form-label">Artists:</label>
                        <div class="container" id="artists"></div>
                    </div> 
                </form>
                <button class="btn btn-success btn-sm" id="addSelectArtist" 
                    onclick="addSelectArtist()">Add Artist</button>
                <button class="btn btn-secondary btn-sm" id="deleteSelectArtist" 
                    onclick="removeSelectArtist()">Remove Artist</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formArtist">Add</button>
            </div>
        </div>
    </div>
</div>
@if($errors->has('addError') || Session::get('success'))
    <script>
        onBackFromControllerAddAlbum();
    </script>
@endif