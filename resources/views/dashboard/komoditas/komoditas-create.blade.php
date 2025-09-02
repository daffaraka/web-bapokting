@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Komoditas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('komoditas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="fw-bold  for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>

    </div>
@endsection

