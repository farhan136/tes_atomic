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

<a href="{{route('kategori.create')}}" class="btn btn-primary">Buat Baru</a>
<select name="status" id="filterStatus" class="btn btn-secondary">
  <option value=""  selected>Filter Status</option>
  <option value="1">Aktif</option>
  <option value="2">Tidak Aktif</option>
</select>


<div class="card">
  <div class="card-header">
    <h3 class="card-title">Kategori</h3>
    <br>
    
</div>

<div class="card-body">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach($kategori as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>Kategori {{$d->nama}}</td>
            <td>{{$d->deskripsi}}</td>
            <td>{{$d->status->nama}}</td>
            <td>
                <a href="{{route('kategori.show', $d->id)}}" class="btn btn-secondary"><i class="fas fa-search">Detail</i></a>
                <a href="{{route('kategori.edit', $d->id)}}" class="btn btn-secondary"><i class="fas fa-pen">Ubah</i></a>
                <a href="{{url('kategori/ubahStatus', $d->id)}}" class="btn btn-secondary"><i class="fas fa-times">
                  @if($d->status->nama == 'aktif')
                  tidak aktif
                  @elseif($d->status->nama == 'tidak aktif')
                  aktif
                  @endif
                </i></a>
            </td>
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
        // "serverSide": true
    });

    $('#filterStatus').on('change', function(){
        let statusFiltered = $('#filterStatus').val();

    });
} );
</script>
@endsection