@extends('welcome')
@section('judul', 'Kategori')
@section('konten')
@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
  Buat Baru
</button>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Kategori</h3>
    <br>
    
  </div>

  <div class="card-body">
    <table id="tabelkategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@include('master.kategori.tambah')

@include('master.kategori.ubah')

@include('master.kategori.hapus')

@endsection  
@section('scripttambahan')
<script>
  let token = $("meta[name='csrf-token']").attr("content");
  $(document).ready(function() {
    const tabel = $('#tabelkategori').DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url:  "{{route('kategori.index')}}",
        type: "GET",
      },
      autowidth : true,
      columns:[
      { data :"nama", name: "nama"},
      { data :"deskripsi", name: "deskripsi"},
      { data :"status", name: "status"},
      { data :"aksi", name: "aksi", searchable:false, sortable:false},
      ],
      lengthMenu:[[10,15,25, -1], ["splh","lmbls","dwplhlm", "semua"]],
    });

    $('#form-kategori-tambah').submit(function(){
      e.preventDefault();
      let nama = $('#nama').val();
      let deskripsi = $('#deskripsi').val()
      let status = $('input[status]:checked').val()
      $.ajax({
        url: "{{route('kategori.store')}}",
        method : "POST",
        data: {
          'nama': nama,
          'deskripsi' : deskripsi,
          'status': status
        },
        success: function(res){
          if (res==true) {
                $('#form-kategori-tambah').trigger("reset"); //mereset data form setelah mengirim data ke database
                $('#tutupModal').trigger('click'); //tutup modal
                tabel.ajax.reload(); //reload datatable
              }

            }
          })
    })

    $('body').on('click', '#tombol-hapus', function () {
      let data_id = $(this).data('id');
      
      $('#submit-hapus-kategori').on('click', function(e){
        $.ajax({
          url:"{{url('kategori/kategori')}}"+"/"+data_id,
          type : "DELETE",
          method: "DELETE",
          data:{
           _token : token
         },
         success:function(res){
          if(res.status=="success"){
            tabel.ajax.reload();
            $('#tutup-hapus').trigger('click');
          }else{
            console.log("gagal")
          }
        }
      }) 
      })
    });

    $('body').on('click', '#tombol-edit', function () {
      let data_id = $(this).data('id');

      $.ajax({
        url: "{{url('kategori/kategori')}}"+"/"+data_id+"/edit",
        type: "GET",
        method: "GET",
        success: function(data){
          $('#nama-edit').val(data.nama);
          $('#deskripsi-edit').val(data.deskripsi);
          $('input[name="status-edit"]:checked').val(data.status_id);
          $('#form-edit').attr("action", "{{route('kategori.update',"+data.id+")}}")

          console.log(data)
        }
      })

      $('#form-edit').on('submit', function(e){
        e.preventDefault();
        let nama = $('#nama-edit').val();
        let deskripsi = $('#deskripsi-edit').val();
        let status = $('input[name="status-edit"]:checked').val();
        console.log(data_id)
        $.ajax({
          url:"{{url('kategori/kategori')}}"+"/"+data_id,
          type : "PUT",
          method: "PUT",
          data:{
           id : data_id,
           _token : token,
           nama : nama,
           deskripsi : deskripsi,
           status : status
         },
         success:function(res){
          if(res.status=="success"){
            window.location.reload()
          }else{
            console.log("gagal")
          }
              }
            })  
      })
    });

    $('#modal-edit').on('hidden.bs.modal', function (e) {
      window.location.reload()
    })

    $('body').on('click', '#tombol-ubah-status', function () {
      let data_id = $(this).data('id');
      console.log(data_id)
      $.ajax({
        url : "{{url('kategori/ubahStatus')}}"+"/"+data_id,
        type : "GET",
        method: "GET",
        success:function(res){
          if(res.status=="success"){
            tabel.ajax.reload();
          }else{
            console.log("gagal")
          }
        }
      })
    });

  });
</script>
@endsection