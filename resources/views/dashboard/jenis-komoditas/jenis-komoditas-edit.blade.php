@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Komoditas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis-komoditas.update', $jenisKomoditas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="fw-bold" for="">Pilih Komoditas</label>
                    <select name="komoditas_id" id="komoditas_" class="form-control">
                        <option value="">Pilih Komoditas</option>
                        @foreach ($komoditas as $kom)
                            <option value="{{ $kom->id }}" {{ $kom->id == $jenisKomoditas->komoditas_id ? 'selected' : '' }}>
                                {{ $kom->nama_komoditas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="fw-bold" for="nama">Nama Jenis</label>
                    <input type="text" name="nama_jenis" id="nama_jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        value="{{ old('nama_jenis', $jenisKomoditas->nama_jenis) }}" required>
                    @error('nama_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold" for="harga">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="form-control @error('harga') is-invalid @enderror"
                        value="{{ old('harga', $jenisKomoditas->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="fw-bold" for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror"
                        required>
                        <option value="">Pilih Satuan</option>
                        <option value="kg" {{ old('satuan', $jenisKomoditas->satuan) == 'kg' ? 'selected' : '' }}>Kg
                        </option>
                        <option value="ons" {{ old('satuan', $jenisKomoditas->satuan) == 'ons' ? 'selected' : '' }}>Ons
                        </option>
                        <option value="liter" {{ old('satuan', $jenisKomoditas->satuan) == 'liter' ? 'selected' : '' }}>
                            Liter</option>
                        <option value="bungkus"
                            {{ old('satuan', $jenisKomoditas->satuan) == 'bungkus' ? 'selected' : '' }}>Bungkus</option>
                        <option value="botol" {{ old('satuan', $jenisKomoditas->satuan) == 'botol' ? 'selected' : '' }}>
                            Botol</option>
                        <option value="grosir" {{ old('satuan', $jenisKomoditas->satuan) == 'grosir' ? 'selected' : '' }}>
                            Grosir</option>
                        <option value="pcs" {{ old('satuan', $jenisKomoditas->satuan) == 'pcs' ? 'selected' : '' }}>Pcs
                        </option>
                        <option value="sachet" {{ old('satuan', $jenisKomoditas->satuan) == 'sachet' ? 'selected' : '' }}>
                            Sachet</option>
                        <option value="paket" {{ old('satuan', $jenisKomoditas->satuan) == 'paket' ? 'selected' : '' }}>
                            Paket</option>
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
