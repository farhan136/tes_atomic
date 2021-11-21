@extends('welcome')
@section('judul', 'Dompet')
@section('konten')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<!-- <a href="{{route('dompet.create')}}" class="btn btn-primary">Buat Baru</a> -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
  Buat Baru
</button>
<select name="status" id="filterStatus" class="btn btn-secondary">
  <option value=""  selected>Filter Status</option>
  <option value="1">Aktif</option>
  <option value="2">Tidak Aktif</option>
</select>


<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dompet</h3>
    <br>
    
</div>

<div class="card-body">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
              <!-- <th>No</th> -->
              <th>Nama</th>
              <th>Referensi</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th>Aksi</th>
          </tr>
      </thead>
</table>
</div>
</div>

@include('master.dompet.tambah')
@endsection  
@section('scripttambahan')
<script>
  $(document).ready(function() {
    const tabel = $('#example').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
          url:  "{{route('dompetindex')}}",
          type: "GET"
        },
        columns:[
            { data :"nama", name: "nama"},
            { data :"referensi", name: "referensi"},
            { data :"deskripsi", name: "deskripsi"},
            { data :"status", name: "status"},
            { data :"aksi", name: "aksi", searchable:false, sortable:false},
        ],
        lengthMenu:[[10,15,25], ["splh","lmbls","dwplhlm"]]
    });

    $('#form-create').on('submit', function(e){ //jika form-create di submit maka jalankan function berikut
        e.preventDefault();
        $('#form-create').ajaxSubmit({
          success:function(res){
            tabel.ajax.reload(null, false) // variabel tabel diambil dari datatables null false berguna agar setelah di reload tetap berada di halaman pagination yang sama
            $("#form-create input:not([name='_token']").val('') //mengosongkan semua input pada form kecuali csrf token
            $('#status1').attr('checked', true); //mengubah status menjadi bernilai aktif (default)
            $('#tutupModal').trigger('click');
          }
        })

    });
} );
</script>
@endsection