@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Perkembangan Harga</h3>
        </div>
        <div class="card-body">

            {{-- <div class="d-flex justify-content-end gap-3 mb-4"> --}}
            <form action="{{ route('perkembangan-harga.download-file') }}" method="POST">
                @csrf
                <div class="row mb-5">
                    <div class="col-3">
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                            <input type="date" name="tanggal_awal" class="form-control"
                                value="{{ request()->query('tanggal_awal') }}" placeholder="Tanggal Awal"
                                aria-label="Tanggal Awal" aria-describedby="basic-addon1">

                        </div>

                    </div>



                    <div class="col-3">
                        <div class="input-group">
                            <input type="date" name="tanggal_akhir" class="form-control"
                                value="{{ request()->query('tanggal_akhir') }}" placeholder="Tanggal Akhir"
                                aria-label="Tanggal Akhir" aria-describedby="basic-addon1">
                            <span class="input-group-text">s/d</span>

                        </div>


                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-success" name="download" value="excel"><i
                                class="fas fa-file-excel"></i>
                            Download Excel</button>

                        <button type="submit" class="btn btn-danger" name="download" value="pdf"><i
                                class="fas fa-file-pdf"></i>
                            Download PDF</button>
                    </div>

                </div>


            </form>

            {{-- </div> --}}



            <div class="table-responsive mt-4">
                <table id="basic-datatables" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Komoditas</th>
                            <th>Jenis Komoditas</th>
                            <th>Nama Pasar</th>
                            <th>UPTD</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perkembanganHargas as $k => $perkembanganHarga)
                            @foreach ($perkembanganHarga['harga_monitorings'] as $i => $monitoring)
                                <tr>
                                    <td>{{ $k + 1 . '.' . ($i + 1) }}</td>
                                    <td>{{ $perkembanganHarga['komoditas'] }}</td> {{-- Komoditas langsung ditaruh di kolom --}}
                                    <td>{{ $monitoring->jenis_komoditas->nama_jenis }}</td>
                                    <td>{{ $monitoring->pasar->nama }}</td>
                                    <td>{{ $monitoring->pasar->uptd->nama_uptd }}</td>
                                    <td>{{ \Carbon\Carbon::parse($monitoring->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td>{{ 'Rp ' . number_format($monitoring->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="form-button-action gap-2">
                                            <a href="{{ route('perkembangan-harga.edit', $monitoring->id) }}"
                                                class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            @can('perkembangan-harga-delete')
                                                <form action="{{ route('perkembangan-harga.destroy', $monitoring->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm deleteBtn"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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

        };


        registerDeleteItemHandlers();



        $('#basic-datatables').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            columnDefs: [{
                    orderable: false,
                    targets: [7]
                },

            ],
            rowGroup: {
                dataSrc: 1 // kolom ke-2 → "Nama Komoditas"
            }
        }).on("draw.dt", function() {
            registerDeleteItemHandlers();
        });




        // var multipleLineChart = document
        //     .getElementById("multipleLineChart")
        //     .getContext("2d");


        // var myMultipleLineChart = new Chart(multipleLineChart, {
        //     type: "line",
        //     data: {
        //         labels: [
        //             "Jan",
        //             "Feb",
        //             "Mar",
        //             "Apr",
        //             "May",
        //             "Jun",
        //             "Jul",
        //             "Aug",
        //             "Sep",
        //             "Oct",
        //             "Nov",
        //             "Dec",
        //         ],
        //         datasets: [{
        //                 label: "Python",
        //                 borderColor: "#1d7af3",
        //                 pointBorderColor: "#FFF",
        //                 pointBackgroundColor: "#1d7af3",
        //                 pointBorderWidth: 2,
        //                 pointHoverRadius: 4,
        //                 pointHoverBorderWidth: 1,
        //                 pointRadius: 4,
        //                 backgroundColor: "transparent",
        //                 fill: true,
        //                 borderWidth: 2,
        //                 data: [30, 45, 45, 68, 69, 90, 100, 158, 177, 200, 245, 256],
        //             },
        //             {
        //                 label: "PHP",
        //                 borderColor: "#59d05d",
        //                 pointBorderColor: "#FFF",
        //                 pointBackgroundColor: "#59d05d",
        //                 pointBorderWidth: 2,
        //                 pointHoverRadius: 4,
        //                 pointHoverBorderWidth: 1,
        //                 pointRadius: 4,
        //                 backgroundColor: "transparent",
        //                 fill: true,
        //                 borderWidth: 2,
        //                 data: [10, 20, 55, 75, 80, 48, 59, 55, 23, 107, 60, 87],
        //             },
        //             {
        //                 label: "Ruby",
        //                 borderColor: "#f3545d",
        //                 pointBorderColor: "#FFF",
        //                 pointBackgroundColor: "#f3545d",
        //                 pointBorderWidth: 2,
        //                 pointHoverRadius: 4,
        //                 pointHoverBorderWidth: 1,
        //                 pointRadius: 4,
        //                 backgroundColor: "transparent",
        //                 fill: true,
        //                 borderWidth: 2,
        //                 data: [10, 30, 58, 79, 90, 105, 117, 160, 185, 210, 185, 194],
        //             },
        //         ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         legend: {
        //             position: "top",
        //         },
        //         tooltips: {
        //             bodySpacing: 4,
        //             mode: "nearest",
        //             intersect: 0,
        //             position: "nearest",
        //             xPadding: 10,
        //             yPadding: 10,
        //             caretPadding: 10,
        //         },
        //         layout: {
        //             padding: {
        //                 left: 15,
        //                 right: 15,
        //                 top: 15,
        //                 bottom: 15
        //             },
        //         },
        //     },
        // });
    </script>
@endpush
