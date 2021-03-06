<div class="modal fade" id="tambah">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closemodal">Buat Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true" id="tutupModal">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{route('kategori.store')}}" id="form-kategori-tambah">
          @csrf
          <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" >
            @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">
            @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Status</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                  <label class="form-check-label" for="status1">
                    aktif
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status2" value="2">
                  <label class="form-check-label" for="status2">
                    tidak aktif
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          <button type="submit" class="btn btn-primary" id="submit-tambah-kategori">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>