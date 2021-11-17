@extends('welcome')
@section('judul', 'Buat Transaksi Baru')
@section('konten')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Transaksi Baru</h3>
    <br>

  </div>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="card-body">
    <form method="post" action="{{route('transaksi.store')}}">
      @csrf
      <div class="form-group">
        <label for="kode">Kode</label>
        <input type="text" class="form-control" id="kode" name="kode" value="WINxxxxx" readonly>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{date('d-m-Y')}}" readonly>
      </div>

      <select name="kategori" class="btn btn-secondary">
        <option value=""  selected>Kategori</option>
        @foreach($kategori as $k)
        <option value="{{$k->id}}">Kategori {{$k->nama}}</option>
        @endforeach
      </select>

      <select name="dompet" class="btn btn-secondary">
        <option value=""  selected>Dompet</option>
        @foreach($dompet as $d)
        <option value="{{$d->id}}">Dompet {{$d->nama}}</option>
        @endforeach
      </select>

      <div class="form-group">
        <label for="nilai">Nilai</label>
        <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" min="0">
        @error('nilai')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">
        @error('deskripsi')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection