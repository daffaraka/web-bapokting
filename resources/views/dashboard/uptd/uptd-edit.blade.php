@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit UPTD</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user-uptd.update', $uptd->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 border-bottom">
                    <div class="form-group">
                        <label class="fw-bold  for="name"><b>Nama User</b></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ $uptd->user->name ?? old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="fw-bold  for="email"><b>Email</b></label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ $uptd->user->email ?? old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="fw-bold  for="password"><b>Password</b></label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="fw-bold  for="role"><b>Role</b></label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                            required>
                            <option value="">Pilih Jabatan</option>
                            <option value="admin"
                                {{ old('role', $uptd->user->roles->first()->name) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="op_uptd"
                                {{ old('role', $uptd->user->roles->first()->name) == 'op_uptd' ? 'selected' : '' }}>Operator
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="fw-bold  for="name">Nama UPTD</label>
                    <input type="text" name="nama_uptd" id="nama_uptd"
                        class="form-control @error('nama_uptd') is-invalid @enderror"
                        value="{{ old('nama_uptd', $uptd->nama_uptd) }}" required>
                    @error('nama_uptd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="fw-bold  for="pasar" class="fw-bold">Pasar (Yang belum mempunyai UPTD)</label>
                    <div class="row">
                        @foreach ($pasar as $key => $p)
                            @if ($key % 4 == 0)
                    </div>
                    <div class="row">
                        @endif
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input @error('pasar_id') is-invalid @enderror" type="checkbox"
                                    name="pasar_id[]" id="pasar_{{ $p->id }}" value="{{ $p->id }}"
                                    {{ in_array($p->id, old('pasar_id', $uptd->pasars->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="fw-bold  class="form-check-label" for="pasar{{ $p->id }}">{{ $p->nama }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('pasar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="px-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
