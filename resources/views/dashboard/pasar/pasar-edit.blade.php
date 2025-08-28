@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Pasar</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pasar.update', $pasar->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pasar->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $pasar->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="uptd_id">UPTD  masih tersedia</label>
                    <select name="uptd_id" id="uptd_id" class="form-control @error('uptd_id') is-invalid @enderror" required>
                        <option value="">Pilih UPTD Yang</option>
                        @foreach ($uptd as $u)
                            <option value="{{ $u->id }}" {{ old('uptd_id', $pasar->uptd_id) == $u->id ? 'selected' : '' }}>{{ $u->nama_uptd }}</option>
                        @endforeach
                    </select>
                    @error('uptd_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

