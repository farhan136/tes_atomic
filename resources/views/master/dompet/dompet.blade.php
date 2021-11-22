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

@include('master.dompet.ubah')

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
      autowidth : true,
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
            $('#form-create').trigger("reset"); //mereset data form setelah mengirim data ke database
            $('#tutupModal').trigger('click');
          }
        })

    });

        //TOMBOL EDIT DATA PER PEGAWAI DAN TAMPIKAN DATA BERDASARKAN ID PEGAWAI KE MODAL
        //ketika id tombol_edit yang ada pada tag body di klik maka
        $('body').on('click', '#tombol_edit', function () {
          let data_id = $(this).data('id'); //mengambil id yang dikirim dari atribut data-id
          console.log(data_id);

          $('.tombol'+data_id).trigger('show');
          $('#form-edit').attr('action', '{{route("dompet.update", '+ data_id +')}}') //set atribut action


          $.get('dompet/dompet/' + data_id + '/edit', function(data){

            //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
            $('#idedit').val(data.id);
            $('#editnama').val(data.nama);
            $('#editreferensi').val(data.referensi);
            $('#editdeskripsi').val(data.deskripsi);
            $('input:radio[name="editStatus"][value="'+data.status_id+'"]').attr('checked',true);

            $('#form-edit').on('submit', function(e){ //jika form-edit di submit maka jalankan function berikut
              e.preventDefault();
              // $.post({
              //   url: 'dompet/dompet/' + data_id, //post data ke url
              //   success: function(res){
              //     $('#form-edit').trigger("reset"); //mereset data form setelah mengirim data ke database
              //     $('#tutupModal').trigger('click');
              //   }});

              $('#form-edit').ajaxSubmit({
                success:function(res){
                  $('#form-edit').trigger("reset"); //mereset data form setelah mengirim data ke database
                  $('#tutupModal').trigger('click');
                }
              })

            });

          });


        });
      } );
    </script>
    @endsection