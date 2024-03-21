@extends('layouts.master')

@section('title', 'Dashboard | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    
    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4 > Invoice</h4>
                    <p><b>{{ $invoiceCount }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4 > Quatation</h4>
                    <p><b>{{ $invoiceCount }}</b></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4 >Customer</h4>
                    <p><b>{{ $customerCount }}</b></p>
                </div>
            </div>
        </div>
   

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4 >Product</h4>
                    <p><b>{{ $productCount }}</b></p>
                </div>
            </div>
        </div>  

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Monthly Sales</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Product Sales Distribution</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div>
        
</main>

@endsection
@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var salesData = {
        labels: ["January", "February", "March", "April", "May", "June","July"],
        datasets: [{
            label: 'Sales',
            data: [1000, 1500, 1200, 1800, 2000, 2500], // Sample sales data
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Get canvas element
    var ctx = document.getElementById('lineChartDemo').getContext('2d');

    // Create line chart
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: salesData,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    // Mock product sales data (replace this with actual data)
    var productSalesData = {
        labels: ["Product A", "Product B", "Product C", "Product D"],
        datasets: [{
            data: [300, 200, 400, 150], // Sample sales data
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)'
            ]
        }]
    };

    // Get canvas element
    var ctxPie = document.getElementById('pieChartDemo').getContext('2d');

    // Create pie chart
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: productSalesData
    });
</script>


@endpush

