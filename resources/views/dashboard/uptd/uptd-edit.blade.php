@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit UPTD</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('uptd.update', $uptd->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama UPTD</label>
                    <input type="text" name="nama" id="nama"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('name', $uptd->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pasar">Pasar</label>
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
                                <label class="form-check-label" for="pasar{{ $p->id }}">{{ $p->nama }}</label>
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

