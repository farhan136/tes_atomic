@extends('welcome')
@section('judul', 'Detail Dompet')
@section('konten')

<div class="card">
  <div class="card-header">
    
    <h3 class="card-title">Detail Dompet</h3>
    <br>

  </div>

  <div class="card-body">
    <h5>Nama : {{$dompet->nama}}</h5>
    <h5>Referensi : {{$dompet->referensi}}</h5>
    <h5>Deskripsi : {{$dompet->deskripsi}}</h5>
    <h5>Status : {{$dompet->status->nama}}</h5>
  </div>
</div>

@endsection