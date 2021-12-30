@extends('welcome')
@section('judul', 'Filter')
@section('konten')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Filter</h3>
    <br>

  </div>

  <div class="card-body">
    <form method="post" action="{{route('transaksi.filter')}}">
      @csrf
      <div class="form-group">
        <label for="awal">Tanggal Awal</label>
        <input type="date" class="form-control" id="awal" name="awal" value="{{date('d-m-Y')}}">
      </div>
      
      <div class="form-group">
        <label for="akhir">Tanggal Akhir</label>
        <input type="date" class="form-control" id="akhir" name="akhir" value="{{date('d-m-Y')}}">
      </div>

      <select name="kategori" class="btn btn-secondary">
        <option value=""  selected>Kategori</option>
        @foreach($kategori as $k)
        <option value="{{$k->id}}">{{$k->nama}}</option>
        @endforeach
      </select>

      <select name="dompet" class="btn btn-secondary">
        <option value=""  selected>Dompet</option>
        @foreach($dompet as $d)
        <option value="{{$d->id}}">{{$d->nama}}</option>
        @endforeach
      </select>

      <select name="status" class="btn btn-secondary">
        <option value=""  selected>Status</option>
        <option value="1">Masuk</option>
        <option value="2">Keluar</option>
      </select>
    
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection