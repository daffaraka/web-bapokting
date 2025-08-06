@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">UPTD Table</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uptds as $uptd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $uptd->nama }}</td>
                                <td>
                                    <div class="form-button-action gap-2">
                                        <a href="{{ route('uptd.edit', $uptd->id) }}" class="btn btn-primary " data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('uptd.destroy', $uptd->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#basic-datatables").DataTable({});
    </script>
@endpush

