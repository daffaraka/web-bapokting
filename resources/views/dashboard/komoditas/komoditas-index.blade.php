@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Komoditas Table</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga (Rp)</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komoditas as $komoditas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $komoditas->nama }}</td>
                                <td>{{ $komoditas->jenis }}</td>
                                <td>Rp.{{ number_format($komoditas->harga, 1, '', '.') }}</td>
                                <td>
                                    <button
                                        class="btn {{ $komoditas->satuan == 'kg' ? 'btn-primary' : ($komoditas->satuan == 'liter' ? 'btn-secondary' : 'btn-warning') }}">
                                        {{ strtoupper($komoditas->satuan) }}
                                    </button>
                                </td>
                                <td>
                                    <div class="form-button-action gap-2">
                                        <a href="{{ route('komoditas.edit', $komoditas->id) }}" class="btn btn-primary "
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('komoditas.destroy', $komoditas->id) }}" method="POST"
                                            style="display:inline;" id="form_delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="deleteBtn btn btn-danger" data-bs-toggle="tooltip"
                                                title="Delete">
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

        $(".deleteBtn").click(function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: 'Anda yakin?',
                text: "Data tidak dapat dikembalikan!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: "Ya, hapus!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((hapus) => {
                if (hapus) {
                    form.submit();
                } else {
                    swal.close();
                }
            });
        })

        $(".deleteBtn").click(function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: 'Anda yakin?',
                text: "Data tidak dapat dikembalikan!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: "Ya, hapus!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((hapus) => {
                if (hapus) {
                    form.submit();
                } else {
                    swal.close();
                }
            });
        })
    </script>
@endpush
