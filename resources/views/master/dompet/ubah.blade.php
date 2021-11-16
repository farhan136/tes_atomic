@extends('welcome')
@section('judul', 'Edit Dompet')
@section('konten')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit Dompet</h3>
    <br>

  </div>

  <div class="card-body">
    <form method="post" action="{{route('dompet.update', $dompet->id)}}">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="nama">Nama Dompet</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama', $dompet->nama)}}">
        @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="referensi">Referensi</label>
        <input type="text" class="form-control @error('referensi') is-invalid @enderror" id="referensi" name="referensi" value="{{old('referensi', $dompet->referensi)}}">
        @error('referensi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{old('deskripsi', $dompet->deskripsi)}}">
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