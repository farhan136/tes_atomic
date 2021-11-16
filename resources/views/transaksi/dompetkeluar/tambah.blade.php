@extends('welcome')
@section('judul', 'Buat Dompet Keluar Baru')
@section('konten')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dompet Keluar---Buat Baru</h3>
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
      <input type="hidden" name="info" value="keluar" readonly>
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
        <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" >
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
      <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Status</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
              <label class="form-check-label" for="status1">
                aktif
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="status2" value="2">
              <label class="form-check-label" for="status2">
                tidak aktif
              </label>
            </div>
          </div>
        </div>
      </fieldset>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection