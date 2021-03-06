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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel">
  Import Excel
</button>
<a download href="{{route('export-to-excel')}}" class="btn btn-success">Export ke Excel</a>
<button type="button" class="btn btn-danger" id="ubah-status" disabled>
  Ubah Status
</button>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <div class="col-md-4">
    <label>
      <input type="checkbox" data-kolom="1" id="tampilan-nama" name="tampilan" checked="true">Nama</input>
    </label>
  </div>
  <div class="col-md-4">
    <label>
      <input checked="true" type="checkbox" data-kolom="2" id="tampilan-referensi" name="tampilan">Referensi</input>  
    </label>
  </div>
  <div class="col-md-4">
    <label>
      <input type="checkbox" checked="true" data-kolom="3" id="tampilan-deskripsi" name="tampilan">Deskripsi</input>  
    </label>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dompet</h3>
    <br>
    
  </div>

  <div class="card-body">
    <div class="tabel-responsive">
      <table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              <input type="checkbox" name="cb-head" id="cb-head">
            </th>
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
</div>

@include('master.dompet.tambah')

@include('master.dompet.ubah')

@include('master.dompet.hapus')

@include('master.dompet.importexcel')

@endsection  

@section('scripttambahan')
<script>
  let yangDiCheck = 0;
  let statusfiltered = $('#filterStatus').val()
  $(document).ready(function() {
    const tabel = $('#example').DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url:  "{{route('dompetindex')}}",
        type: "GET",
        data : function(d){ //untuk mengirim data ke controller, nanti ngambilnya dengan $request->input('statusfiltered')
        d.statusfiltered = statusfiltered
        return d
        },
      },
      autowidth : true,
      columns:[
      { data :"cb", name: "cb-head", searchable:false, sortable:false},
      { data :"nama", name: "nama"},
      { data :"referensi", name: "referensi"},
      { data :"deskripsi", name: "deskripsi"},
      { data :"status", name: "status"},
      { data :"aksi", name: "aksi", searchable:false, sortable:false},
      ],
      lengthMenu:[[10,15,25, -1], ["splh","lmbls","dwplhlm", "semua"]],
    });

    $('#tambah-dompet').on('click', function(e){ //jika form-create di submit maka jalankan function berikut
      e.preventDefault();
      $('#form-create').ajaxSubmit({
        success:function(res){
            $('#form-create').trigger("reset"); //mereset data form setelah mengirim data ke database
            $('#tutupModal').trigger('click'); //tutup modal
            tabel.ajax.reload(); //reload datatable
          }
        })
      $('#tutupModal').trigger('click'); //tutup modal
      tabel.ajax.reload(); //reload datatable
    });

    //validasi form tambah
    var validator = $('#form-create').validate({
      errorElement: "em",
      errorClass: "error",
      rules:
        {
          nama: {
            required: true,
            maxlength: 255
          },
          referensi:{
            maxlength: 255
          },
          deskripsi:{
            maxlength: 255
          }
        },
      messages: {
        nama: {
          required: "Gaboleh Kosong",
          maxlength: "Tidak boleh lebih dari 5"
        },
        referensi:{
          maxlength: "Tidak boleh lebih dari 255"
        },
        deskripsi:{
          maxlength: "Tidak boleh lebih dari 255"
        }
      }
    });

    $('#tutupModal').on('click', function(){
      $('#form-create').trigger("reset");
      validator.destroy();
    })

    //ketika id tombol_edit yang ada pada tag body di klik maka
    $('body').on('click', '#tombol_edit', function () {
      let data_id = $(this).data('id'); //mengambil id yang dikirim dari atribut data-id
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
              $('#tutupModalEdit').trigger('click');
              tabel.ajax.reload();
            }
          })

        });

      });
    });

    $('body').on('click','#tombol_ubah_status',  function () {
      let data_id = $(this).data('id');
      const _c = confirm('Apakah anda yakin?')
      if (_c==true) {
        $.ajax('dompet/ubahStatus/' + data_id, 
        {
        success: function (res) {// success callback function
          tabel.ajax.reload(null, false)
        }
      })  
      }
    })

    $('#cb-head').change(function(){
      if($(this).is(':checked')){
        $('[id="cb-child"]').prop("checked", true);//'[id="cb-child"]' untuk mengambil semua item yang memiliki id cb-child
        $('#ubah-status').prop('disabled', false)
        $('#aktifkan').prop('disabled', false)
      }else{
        $('[id="cb-child"]').prop("checked", false);
        $('#ubah-status').prop('disabled', true)
        $('#aktifkan').prop('disabled', true)
      }
    });

    $("#example").on('click','#cb-child',function(){
      let datas = []
      let data_id = $(this).data('id')
      datas.push(data_id)

      if($(this).prop('checked')!=true){
        $("#cb-head").prop('checked',false)
      }

      let semua_checked = $("#example #cb-child:checked")

      if(semua_checked.length > 0){
        $('#ubah-status').prop('disabled', false)
        $('#aktifkan').prop('disabled', false)
      }else{
        $('#ubah-status').prop('disabled', true)
        $('#aktifkan').prop('disabled', true)
      }

      $('#ubah-status').on('click', function(){
        $.each(datas, function(i, val){
          $.ajax({
            url : "/dompet/ubahStatus/"+ val ,
            type: "GET",
            success: function (res) {// success callback function
              tabel.ajax.reload(null, false)
            }

          })  
        })
        
      })   
    })

    $('#filterStatus').on('change', function(){
      statusfiltered = $('#filterStatus').val()
      console.log(statusfiltered)
        tabel.ajax.reload(null, false) //setiap kali filter berubah maka tabelnya reload
      })

    $('[name="tampilan"]').change(function(){

      // Get the column API object
      var column = tabel.column( $(this).attr('data-kolom') );
      
      // Toggle the visibility
      column.visible( ! column.visible() );
    })

    $('body').on('click', '#tombol-hapus', function () {
      let data_id = $(this).data('id');
      let token = $("meta[name='csrf-token']").attr("content");
      console.log(data_id)
      
      $('#submit-hapus-dompet').on('click', function(e){
        $.ajax({
            url:"{{url('dompet/dompet')}}"+"/"+data_id,
            type : "DELETE",
            method: "DELETE",
            data:{
             _token : token
            },
            success:function(res){
              if(res.status=="success"){
                tabel.ajax.reload();
                $('#tombol-tutup').trigger('click');
              }else{
                console.log("gagal")
              }
            }
        }) 
      })


    });

  } );


</script>
@endsection