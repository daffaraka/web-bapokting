@extends('frontend.base-layout')
@section('title', 'Harga Barang Per Pasar')
@section('content')

    <style>
        #basic-datatables_filter {
            float: right;

        }

        #basic-datatables_paginate{
            float: right;
        }
    </style>
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ $title }}</h1>
            <p>{{ $deskripsi }}</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">Harga Per Pasar</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 py-5">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal_awal" class="form-label">Pasar</label>

                            <select name="pasar_id" id="pasar_id" class="form-control">
                                <option value="">Semua Pasar</option>
                                @foreach ($pasar as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request()->query('pasar_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-4">
                            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                                value="{{ request()->query('tanggal_awal') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                                value="{{ request()->query('tanggal_akhir') }}">
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-warning w-100" id="btnFilter">Filter</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="col-12">

                <div class="table-responsive my-4">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perkembangan as $k => $perkembanganHarga)
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
                                       
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        $('#btnFilter').click(function (e) { 
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            var pasar = $('#pasar_id').val();
        
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "url",
                data: {
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    pasar: pasar
                },
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
            
        });

         $('#basic-datatables').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            columnDefs: [{
                    orderable: false,
                    targets: [6]
                },

            ],
            rowGroup: {
                dataSrc: 1 // kolom ke-2 → "Nama Komoditas"
            }
        });
    </script>
@endpush
