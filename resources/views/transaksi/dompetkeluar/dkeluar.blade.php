@extends('welcome')
@section('judul', 'Dompet Keluar')
@section('konten')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<a href="{{route('transaksi.create')}}" class="btn btn-primary">Buat Baru</a>
<select name="status" id="filterStatus" class="btn btn-secondary">
  <option value=""  selected>Filter Status</option>
  <option value="1">Aktif</option>
  <option value="2">Tidak Aktif</option>
</select>


<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dompet Keluar</h3>
    <br>
    
</div>

<div class="card-body">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kode</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Nilai</th>
              <th>Dompet</th>
          </tr>
      </thead>
      <tbody>
          <!-- @foreach($dompet as $d) -->
          <tr>
            <!-- <td>{{$loop->iteration}}</td> -->
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- @endforeach -->
    </tbody>
</table>
</div>
</div>

@endsection  
@section('scripttambahan')
<script>
  $(document).ready(function() {
    $('#example').DataTable({

    });

} );
</script>
@endsection