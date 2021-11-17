@extends('welcome')
@section('judul', 'Laporan')
@section('konten')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Laporan</h3>
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
          <th>Dompet</th>
          <th>Kategori</th>
          <th>Nilai</th>
        </tr>
      </thead>
      <tbody>
        @foreach($filtered as $f)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$f->tanggal}}</td>
          <td>{{$f->kode}}</td>
          <td>{{$f->deskripsi}}</td>
          <td>Dompet {{$f->dompet}}</td>
          <td>Kategori {{$f->kategori}}</td>
          <td>
            @if($f->status_id == 1)
            (+) {{$f->nilai}}
            @elseif($f->status_id == 2)
            (-) {{$f->nilai}}
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
      <a class="btn btn-primary">Print</a><a href="{{url('transaksi/filter')}}" class="btn btn-secondary">Kembali</a>
    </table>
    <div class="card-footer text-muted">
      Total = 
    </div>
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