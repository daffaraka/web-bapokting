@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Perkembangan Harga</h3>
        </div>
        <div class="card-body">



            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Pasar</th>
                            <th>Nama Komoditas</th>
                            <th>Nama User</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perkembanganHargas as $perkembanganHarga)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perkembanganHarga->pasar->nama }}</td>
                                <td>{{ $perkembanganHarga->komoditas->nama }}</td>
                                <td>{{ $perkembanganHarga->user->name }}</td>
                                <td>{{ $perkembanganHarga->tanggal }}</td>
                                <td>Rp.{{ number_format($perkembanganHarga->harga, 1, '', '.') }}</td>
                                <td>{{ $perkembanganHarga->stok }}</td>
                                <td>
                                    <div class="form-button-action gap-2">
                                        <a href="{{ route('perkembangan-harga.edit', $perkembanganHarga->id) }}" class="btn btn-primary " data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('perkembangan-harga.destroy', $perkembanganHarga->id) }}" method="POST" style="display:inline;">
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
