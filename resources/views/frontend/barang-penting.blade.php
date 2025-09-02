@extends('frontend.base-layout')
@section('title', 'Profil Bidang Bapokting')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Barang Penting</h1>
            <p>{{ $deskripsi }}</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">Barang Penting</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <table class="table table-bordered table-striped" id="basic-datatables">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Komoditas</th>
                    <th>Type</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($barangPenting as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_komoditas }}</td>
                        <td>{{ $item->type_komoditas }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $("#basic-datatables").DataTable({});
        // $(".deleteBtn").click(function(e) {
        //     e.preventDefault();
        //     var form = $(this).parents('form');
        //     swal({
        //         title: 'Anda yakin?',
        //         text: "Data tidak dapat dikembalikan!",
        //         type: 'warning',
        //         buttons: {
        //             confirm: {
        //                 text: "Ya, hapus!",
        //                 className: "btn btn-success",
        //             },
        //             cancel: {
        //                 visible: true,
        //                 className: "btn btn-danger",
        //             },
        //         },
        //     }).then((hapus) => {
        //         if (hapus) {
        //             form.submit();
        //         } else {
        //             swal.close();
        //         }
        //     });
        // })
    </script>
@endpush
