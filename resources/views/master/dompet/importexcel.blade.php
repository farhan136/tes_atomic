<div class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('import-excel')}}" enctype="multipart/form-data" method="post">
          @csrf
          <label>Mohon pilih file excel dengan contoh seperti ini </label><br>
          <a href="{{asset('/contoh/tes.xlsx')}}">tes.xlsx</a>

          <div class="form-group">
            <label for="import-excel">File Excel</label>
            <input type="file" class="form-control" id="import-excel" name="excel">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        
        </form>
      </div>
    </div>
  </div>
</div>