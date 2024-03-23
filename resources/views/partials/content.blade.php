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
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-clipboard fa-3x"></i>
                <div class="info">
                    <h4><b> Invoice</b></h4>
                    <p><b>{{ $invoiceCount }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
                <div class="info">
                    <h4><b>Quatation</b></h4>
                    <p><b>{{ $invoiceCount }}</b></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4><b>Customer</b></h4>
                    <p><b>{{ $customerCount }}</b></p>
                </div>
            </div>
        </div>
   

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4><b>Product</b></h4>
                    <p><b>{{ $productCount }}</b></p>
                </div>
            </div>
        </div>  

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Product Sales</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
                </div>
            </div>
        </div>
        

        <div class="col-md-6">
            <div class="tile">
                
                <div class="form-group d-flex">
                <h3 class="tile-title mr-5">Monthly Sales</h3>

                <div class="d-flex align-items-center mr-4">
                    <label for="yearSelect" class="mr-2"> Year:</label>
                    <select class="form-control" id="yearSelect"></select>
                </div>

                <div class="d-flex align-items-center">
                    <label for="monthSelect" class="mr-2"> Month:</label>
                    <select class="form-control" id="monthSelect"></select>
                </div>
                    
                </div>

                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo1"></canvas>
                </div>
            </div>
        </div> 
    
       
        {{-- <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Product Sales Distribution</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>  --}}


       
    </div>


            
</main>

@endsection
@push('js')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Extract product sales data from PHP array
    var productSalesData = {!! json_encode($sales->pluck('qty', 'product_id')) !!};

    // Extract amount data from PHP array
    var productAmountData = {!! json_encode($sales->pluck('amount', 'product_id')) !!};

    // Get product names
    var productNames = {!! json_encode($sales->pluck('product.name', 'product_id')) !!};

    // Prepare data for the chart
    var barChartData = {
        labels: Object.values(productNames),
        datasets: [{
            label: 'Quantity Sold',
            data: Object.values(productSalesData),
            backgroundColor: 'rgba(35, 119, 142, 0.8)', 
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: 'Sale',
            data: Object.values(productAmountData),
            backgroundColor: 'rgba(83, 105, 125, 0.8)', 
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Get canvas element
    var ctxBar = document.getElementById('barChartDemo').getContext('2d');

    // Create bar chart
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: '#333' // Change tick font color
                    },
                    gridLines: {
                        color: '#eee' // Change grid line color
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: '#333' // Change tick font color
                    },
                    gridLines: {
                        color: '#eee' // Change grid line color
                    }
                }]
            },
            legend: {
                labels: {
                    fontColor: '#333' // Change legend font color
                }
            },
            title: {
                display: true,
                text: 'Product Sales',
                fontColor: '#333' // Change title font color
            }
        }
    });
</script>


<script>
    // Extract sales data from PHP array
    var salesData = {!! json_encode($sales) !!};

    // Function to filter sales data by selected month and year
    function filterSalesData(year, month) {
        return salesData.filter(function(sale) {
            var saleDate = new Date(sale.created_at);
            return saleDate.getFullYear() == year && saleDate.getMonth() + 1 == month;
        });
    }

    // Function to get sales amount for a specific month and year
    function getSalesAmount(year, month) {
        var filteredSales = filterSalesData(year, month);
        return filteredSales.reduce(function(total, sale) {
            return total + sale.amount;
        }, 0);
    }

    // Function to populate year select options
    function populateYearSelect() {
        var years = [];
        salesData.forEach(function(sale) {
            var saleDate = new Date(sale.created_at);
            var year = saleDate.getFullYear();
            if (!years.includes(year)) {
                years.push(year);
            }
        });
        years.sort();
        var yearSelect = document.getElementById('yearSelect');
        years.forEach(function(year) {
            var option = document.createElement('option');
            option.value = year;
            option.text = year;
            yearSelect.add(option);
        });
    }

    // Function to populate month select options
    function populateMonthSelect() {
        var monthSelect = document.getElementById('monthSelect');
        for (var i = 1; i <= 12; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.text = new Date(2000, i - 1, 1).toLocaleString('default', { month: 'long' });
            monthSelect.add(option);
        }
    }

    // Call functions to populate select options
    populateYearSelect();
    populateMonthSelect();

    // Get canvas element
    var ctx = document.getElementById('lineChartDemo1').getContext('2d');

    // Initial month and year
    var initialYear = document.getElementById('yearSelect').value;
    var initialMonth = document.getElementById('monthSelect').value;

    // Initial sales data for the chart
    var initialSalesData = filterSalesData(initialYear, initialMonth);
    var initialSalesAmount = getSalesAmount(initialYear, initialMonth);

    // Create line chart
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Sales Amount',
                data: [],
                fill: false,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Monthly Sales for ' + new Date(2000, initialMonth - 1, 1).toLocaleString('default', { month: 'long' }) + ' ' + initialYear,
                fontSize: 18
            }
        }
    });

    // Update chart data when year or month changes
    document.getElementById('yearSelect').addEventListener('change', function() {
        var year = this.value;
        var month = document.getElementById('monthSelect').value;
        var salesData = filterSalesData(year, month);
        var salesAmount = getSalesAmount(year, month);
        lineChart.data.labels = salesData.map(function(sale) {
            return new Date(sale.created_at).getDate();
        });
        lineChart.data.datasets[0].data = salesData.map(function(sale) {
            return sale.amount;
        });
        lineChart.options.title.text = 'Monthly Sales for ' + new Date(2000, month - 1, 1).toLocaleString('default', { month: 'long' }) + ' ' + year;
        lineChart.update();
    });

    document.getElementById('monthSelect').addEventListener('change', function() {
        var year = document.getElementById('yearSelect').value;
        var month = this.value;
        var salesData = filterSalesData(year, month);
        var salesAmount = getSalesAmount(year, month);
        lineChart.data.labels = salesData.map(function(sale) {
            return new Date(sale.created_at).getDate();
        });
        lineChart.data.datasets[0].data = salesData.map(function(sale) {
            return sale.amount;
        });
        lineChart.options.title.text = 'Monthly Sales for ' + new Date(2000, month - 1, 1).toLocaleString('default', { month: 'long' }) + ' ' + year;
        lineChart.update();
    });
</script>




@endpush

