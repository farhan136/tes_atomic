@extends('welcome')
@section('judul', 'Detail Kategori')
@section('konten')

<div class="card">
  <div class="card-header">
    
    <h3 class="card-title">Detail Kategori</h3>
    <br>

  </div>

  <div class="card-body">
    <h5>Nama : {{$kategori->nama}}</h5>
    <h5>Deskripsi : {{$kategori->deskripsi}}</h5>
    <h5>Status : {{$kategori->status->nama}}</h5>
  </div>
</div>

@endsection