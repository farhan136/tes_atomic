<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" id="tombol-tutup">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-edit">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" class="form-control " id="nama-edit" name="nama" value="{{old('nama')}}">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control " id="deskripsi-edit" name="deskripsi" value="{{old('deskripsi')}}">
            @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Status</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status-edit" id="status1" value="1" checked>
                  <label class="form-check-label" for="status1">
                    aktif
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status-edit" id="status2" value="2">
                  <label class="form-check-label" for="status2">
                    tidak aktif
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>