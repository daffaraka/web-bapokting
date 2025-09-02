@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Komoditas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('komoditas.update', $komoditas->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="fw-bold" for="nama_komoditas">Nama Komoditas</label>
                    <input type="text" name="nama_komoditas" id="nama_komoditas"
                        class="form-control @error('nama_komoditas') is-invalid @enderror" value="{{ old('nama_komoditas', $komoditas->nama_komoditas) }}"
                        required>
                    @error('nama_komoditas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
