@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Komoditas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis-komoditas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Pilih Komoditas</label>
                    <select name="komoditas_id" id="komoditas_" class="form-control">
                        <option value="">Pilih Komoditas</option>
                        @foreach ($komoditas as $kom)
                            <option value="{{ $kom->id }}">{{ $kom->nama_komoditas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Jenis</label>
                    <input type="text" name="nama_jenis" id="nama_jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror" value="{{ old('nama_jenis') }}" required>
                    @error('nama_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror"
                        required>
                        <option value="">Pilih Satuan</option>
                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                        <option value="ons" {{ old('satuan') == 'ons' ? 'selected' : '' }}>Ons</option>
                        <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                        <option value="bungkus" {{ old('satuan') == 'bungkus' ? 'selected' : '' }}>Bungkus</option>
                        <option value="botol" {{ old('satuan') == 'botol' ? 'selected' : '' }}>Botol</option>
                        <option value="grosir" {{ old('satuan') == 'grosir' ? 'selected' : '' }}>Grosir</option>
                        <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="sachet" {{ old('satuan') == 'sachet' ? 'selected' : '' }}>Sachet</option>
                        <option value="paket" {{ old('satuan') == 'paket' ? 'selected' : '' }}>Paket</option>
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type_komoditas">Type Komoditas</label>
                    <select name="type_komoditas" id="type_komoditas" class="form-control @error('type_komoditas') is-invalid @enderror"
                        required>
                        <option value="">Pilih Tipe Komoditas</option>
                        <option value="penting">Penting</option>
                        <option value="pokok">Pokok</option>
                    </select>
                    @error('type_komoditas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>

        </div>
    @endsection
@push('scripts')

@endpush
