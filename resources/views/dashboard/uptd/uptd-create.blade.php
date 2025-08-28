@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body border-bottom">
            <div class="form-group">
                <label for="name"><b>Nama User</b></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role"><b>Role</b></label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="">Pilih Jabatan</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('user-uptd.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><b>Nama UPTD</b></label>
                    <input type="text" name="nama_uptd" id="nama_uptd"
                        class="form-control @error('nama_uptd') is-invalid @enderror" value="{{ old('nama_uptd') }}"
                        required>
                    @error('nama_uptd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role"><b>Pasar</b></label>
                    <div class="row">
                        @foreach ($pasar as $key => $p)
                            @if ($key % 4 == 0)
                    </div>
                    <div class="row">
                        @endif
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input @error('role') is-invalid @enderror" type="checkbox"
                                    name="role[]" id="pasar{{ $p->id }}" value="{{ $p->id }}">
                                <label class="form-check-label" for="pasar{{ $p->id }}">{{ $p->nama }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="px-3">
                    <button type="submit" class="btn btn-primary">Create</button>

                </div>
            </form>

        </div>
    @endsection
