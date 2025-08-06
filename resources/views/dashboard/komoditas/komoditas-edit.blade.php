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
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $komoditas->nama) }}"
                        required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" name="jenis" id="jenis"
                        class="form-control @error('jenis') is-invalid @enderror"
                        value="{{ old('jenis', $komoditas->jenis) }}" required>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="form-control @error('harga') is-invalid @enderror"
                        value="{{ old('harga', $komoditas->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror"
                        required>
                        <option value="">Pilih Satuan</option>
                        <option value="kg" {{ old('satuan', $komoditas->satuan) == 'kg' ? 'selected' : '' }}>Kg</option>
                        <option value="ons" {{ old('satuan', $komoditas->satuan) == 'ons' ? 'selected' : '' }}>Ons</option>
                        <option value="liter" {{ old('satuan', $komoditas->satuan) == 'liter' ? 'selected' : '' }}>Liter</option>
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
