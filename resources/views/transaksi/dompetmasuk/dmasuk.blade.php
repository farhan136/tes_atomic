@extends('welcome')
@section('judul', 'Dompet Masuk')
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

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dompet {{$status}}</h3>
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
          @foreach($transaksi as $t)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->tanggal}}</td>
            <td>{{$t->kode}}</td>
            <td>{{$t->deskripsi}}</td>
            <td>Kategori {{$t->kategori->nama}}</td>
            <td>(+) {{$t->nilai}}</td>
            <td>Dompet {{$t->dompet->nama}}</td>
        </tr>
        @endforeach
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