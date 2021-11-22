<div class="modal fade" id="editModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closemodal">Edit Dompet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutupModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="form-edit"> <!-- tambahkan id untuk membuat ajax -->
          @csrf
          @method('put')
          <input type="hidden" name="id" id="idedit">
          <div class="form-group">
            <label for="nama">Nama Dompet</label>
            <input type="text" class="form-control" id="editnama" name="nama" >
          </div>
          <div class="form-group">
            <label for="referensi">Referensi</label>
            <input type="text" class="form-control" id="editreferensi" name="referensi" value="{{old('referensi')}}">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control" id="editdeskripsi" name="deskripsi" value="{{old('deskripsi')}}">
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>


      </div>
    </div>


  </div>
</div>
</div>
</div>