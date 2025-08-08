@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama UPTD</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Pasar</label>
                    <div class="row">
                        @foreach ($pasar as $key => $p)
                            @if ($key % 4 == 0)
                                </div>
                                <div class="row">
                            @endif
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('role') is-invalid @enderror" type="checkbox" name="role[]" id="pasar{{ $p->id }}" value="{{ $p->id }}">
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
