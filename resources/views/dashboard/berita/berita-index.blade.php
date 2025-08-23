@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Berita Table</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Judul Berita</th>
                            <th>Slug Berita</th>
                            {{-- <th>Gambar Berita</th> --}}
                            <th>User ID</th>
                            <th>Status Berita</th>
                            <th>Tanggal Publish</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $berita->judul_berita }}</td>
                                <td>{{ $berita->slug_berita }}</td>
                                {{-- <td>{{ $berita->gambar_berita }}</td> --}}
                                <td>{{ $berita->user_id }}</td>
                                <td>
                                    @if ($berita->status_berita == 'draft')
                                        <button class="btn btn-warning font-bold text-uppercase">Draft</button>
                                    @else
                                        <button class="btn btn-success font-bold text-uppercase">Published</button>
                                    @endif
                                </td>
                                <td>{{ $berita->published_at }}</td>
                                <td>
                                    <div class="form-button-action gap-2">
                                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-primary "
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-info "
                                            data-bs-toggle="tooltip" title="Show">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                            style="display:inline;">
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
        const registerDeleteItemHandlers = () => {
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

        }


        $("#basic-datatables")
            .DataTable({})
            .on("draw.dt", function() {
                registerDeleteItemHandlers();
            });;
    </script>
@endpush
