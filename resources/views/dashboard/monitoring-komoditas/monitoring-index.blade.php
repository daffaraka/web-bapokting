@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Monitoring Per Komoditas</h3>
        </div>
        <div class="card-body">


            <div class="row">
                <div class="col-md-3">
                    @foreach ($availKomoditas->chunk(4)->first() as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->komoditas_id }}"
                                id="komoditas_{{ $item->komoditas_id }}">
                            <label class="fw-bold" class="form-check-label" for="komoditas_{{ $item->komoditas_id }}">
                                {{ $item->jenis_komoditas->nama_jenis }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    @foreach ($availKomoditas->chunk(4)->get(1) as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->komoditas_id }}"
                                id="komoditas_{{ $item->komoditas_id }}">
                            <label class="fw-bold" class="form-check-label" for="komoditas_{{ $item->komoditas_id }}">
                                {{ $item->jenis_komoditas->nama_jenis }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    @foreach ($availKomoditas->chunk(4)->get(2) as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->komoditas_id }}"
                                id="komoditas_{{ $item->komoditas_id }}">
                            <label class="fw-bold" class="form-check-label" for="komoditas_{{ $item->komoditas_id }}">
                                {{ $item->jenis_komoditas->nama_jenis }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    @foreach ($availKomoditas->chunk(4)->get(3) as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->komoditas_id }}"
                                id="komoditas_{{ $item->komoditas_id }}">
                            <label class="fw-bold" class="form-check-label" for="komoditas_{{ $item->komoditas_id }}">
                                {{ $item->jenis_komoditas->nama_jenis }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <hr>
                <div class="col-12">
                    <div class="chart-container">
                        <canvas id="multipleLineChart" style="height: 500px;"></canvas>
                    </div>

                </div>
            </div>






            {{-- <div class="table-responsive">
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
                                <td>{{ $uptd->nama_uptd }}</td>
                                <td>
                                    <div class="form-button-action gap-2">
                                        <a href="{{ route('user-uptd.edit', $uptd->id) }}" class="btn btn-primary " data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user-uptd.destroy', $uptd->id) }}" method="POST" style="display:inline;">
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
            </div> --}}
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


        $(".checkbox").click(function() {
            $(this).find("input").prop("checked", $(this).find("input").prop("checked") ? false : true);
        });

        var multipleLineChart = document.getElementById("multipleLineChart").getContext("2d");

        var myMultipleLineChart = new Chart(multipleLineChart, {
            type: "line",
            data: {
                labels: {!! json_encode($labels) !!}, // Misal: ['Jan', 'Feb', ...]
                datasets: {!! json_encode($datasets) !!}
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "top",
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    },
                },
            },
        });
    </script>
@endpush
