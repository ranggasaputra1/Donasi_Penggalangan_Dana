@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="page-heading" style="flex-grow: 0">
        <h3>Dashboard</h3>
        <hr>
        <h5>Selamat Datang, {{ Auth::user()->name }}!</h5>
    </div>
    <div class="page-content" style="flex-grow: 1">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Pengguna</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahuser }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fa-solid fa-bullhorn"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Campaign</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahcampaign }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Total Dana Terkumpul</h6>
                                    <h6 class="font-extrabold mb-0">Rp{{ number_format($jumlahdanaterkumpul, 2, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Tables start -->
            <section class="section">
                <div class="row" id="basic-table">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">5 Donatur Dengan Nominal Tertinggi</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    {{-- <p class="card-text">
                        Using the most basic table up, here’s how
                        <code>.table</code>-based tables look in Bootstrap. You
                        can use any example of below table for your table and it
                        can be use with any type of bootstrap tables.
                      </p> --}}
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Peringkat</th>
                                                    <th>Nama Donatur</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php $i = 0 @endphp
                                                @foreach ($nominalterbanyak as $item)
                                                    <tr>
                                                        @php $i++ @endphp
                                                        <td>{{ $i }}</td>
                                                        <td class="text-bold-500">{{ $item->user->name }}</td>
                                                        <td>Rp{{ number_format($item->max, 2, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">5 Donatur Dengan Donasi Terbanyak</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    {{-- <p class="card-text">
                        Using the most basic table up, here’s how
                        <code>.table</code>-based tables look in Bootstrap. You
                        can use any example of below table for your table and it
                        can be use with any type of bootstrap tables.
                      </p> --}}
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Peringkat</th>
                                                    <th>Nama Donatur</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 0 @endphp
                                                @foreach ($donasiterbanyak as $item)
                                                    <tr>
                                                        @php $i++ @endphp
                                                        <td>{{ $i }}</td>
                                                        <td class="text-bold-500">{{ $item->user->name }}</td>
                                                        <td>{{ $item->total }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Tables end -->

        </div>
    </div>
@endsection
