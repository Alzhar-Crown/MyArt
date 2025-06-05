@extends('layout.base')
@section('main')
    <div class="container" style="overflow-y:auto;height:100vh">
        <div class="d-flex flex-row">
            <div class="w-25">
                <div class="card card-primary  " style="margin-left:5%;">
                    <div class="card-header">
                        <h3 class="card-title">Catalogs </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="CatalogDonut"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="w-25">
                <div class="card card-danger  " style="margin-left:5%;">
                    <div class="card-header">
                        <h3 class="card-title">Portofolio </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="PortofolioChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $user }}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('admin.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $transaksi }}</h3>

                        <p>Transaction Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->


                <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Profit</span>
                        <span class="info-box-number">{{$adminWallet->nominal}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>
    </div>
    {{-- <canvas id="donutChart"></canvas> --}}
    {{-- <script src="{{ asset('/theme/plugins/jquery/jquery.min.js') }}"></script> --}}

    <script>
        var donutChartCanvas = $('#CatalogDonut').get(0).getContext('2d')
        var donutData = {
            labels: @json($labelsCatalog),
            datasets: [{
                data: @json($dataCatalog),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
    <script>
        var donutChartCanvas = $('#PortofolioChart').get(0).getContext('2d')
        var donutData = {
            labels: @json($labelsPortofolio),
            datasets: [{
                data: @json($dataPortofolio),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
@endsection
