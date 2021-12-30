<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Laporan PDF</title>
</head>
<body>
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
            <td>{{$f->dompet}}</td>
            <td>{{$f->kategori}}</td>
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
        <a class="btn btn-primary" href="{{url('transaksi/cetak-pdf')}}">Print</a>
        <a href="{{url('transaksi/filter')}}" class="btn btn-secondary">Kembali</a>
      </table>
      <div class="card-footer text-muted">
        Total = {{$total}}
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>