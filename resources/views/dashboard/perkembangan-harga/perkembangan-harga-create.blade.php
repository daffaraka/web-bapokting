@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Perkembangan Harga Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('perkembangan-harga.store') }}" method="POST">
                @csrf


                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pasar_id">UPTD</label>
                            <select name="uptd_id" id="uptd_id"
                                class="form-control @error('uptd_id') is-invalid @enderror" required>
                                <option value="">Pilih Pasar</option>
                                @foreach ($uptd as $u)
                                    <option value="{{ $u->id }}" {{ old('uptd_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->nama_uptd }}</option>
                                @endforeach
                            </select>
                            @error('uptd_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pasar_id">Pasar  <b> (Pilih UPTD terlebih dahulu)</b> </label>
                            <select name="pasar_id" id="pasar_id"
                                class="form-control @error('pasar_id') is-invalid @enderror" required>
                                <option value="">Pilih Pasar</option>

                            </select>
                            @error('pasar_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group">
                            <label for="komoditas_id">Komoditas</label>
                            <select name="komoditas_id" id="komoditas_id"
                                class="form-control @error('komoditas_id') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Komoditas</option>

                            </select>
                            @error('komoditas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="jenis_komoditas_id">Jenis Komoditas <b> (Pilih komoditas terlebih dahulu)</b>  </label>
                            <select name="jenis_komoditas_id" id="jenis_komoditas_id"
                                class="form-control @error('jenis_komoditas_id') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Komoditas</option>

                            </select>
                            @error('jenis_komoditas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
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
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok"
                        class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>

        </div>
    @endsection
