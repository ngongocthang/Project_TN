@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $products }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Category</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $categories }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->
                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">User</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $users }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->
                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card blogs-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Blog</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-post-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $blogs }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->



                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        fetch('/api/reports')
                                            .then(response => response.json())
                                            .then(data => {
                                                const dates = data.dates;
                                                const pendingOrders = dates.map(date => data.pendingOrders[date] || 0);
                                                const paidOrders = dates.map(date => data.paidOrders[date] || 0);
                                                const canceledOrders = dates.map(date => data.canceledOrders[date] || 0);

                                                new ApexCharts(document.querySelector("#reportsChart"), {
                                                    series: [{
                                                        name: 'Pending Orders',
                                                        data: pendingOrders,
                                                    }, {
                                                        name: 'Paid Orders',
                                                        data: paidOrders,
                                                    }, {
                                                        name: 'Canceled Orders',
                                                        data: canceledOrders,
                                                    }],
                                                    chart: {
                                                        height: 350,
                                                        type: 'area',
                                                        toolbar: {
                                                            show: false
                                                        },
                                                    },
                                                    markers: {
                                                        size: 4
                                                    },
                                                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                    fill: {
                                                        type: "gradient",
                                                        gradient: {
                                                            shadeIntensity: 1,
                                                            opacityFrom: 0.3,
                                                            opacityTo: 0.4,
                                                            stops: [0, 90, 100]
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'smooth',
                                                        width: 2
                                                    },
                                                    xaxis: {
                                                        type: 'category',
                                                        categories: dates
                                                    },
                                                    tooltip: {
                                                        x: {
                                                            format: 'dd/MM/yy'
                                                        },
                                                    }
                                                }).render();
                                            })
                                            .catch(error => console.error('Error fetching data:', error));
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Stock <span>| Order</span></h5>

                        <div id="trafficChart" style="min-height: 386px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                fetch('/api/stocks')
                                    .then(response => response.json())
                                    .then(data => {
                                        echarts.init(document.querySelector("#trafficChart")).setOption({
                                            tooltip: {
                                                trigger: 'item'
                                            },
                                            legend: {
                                                top: '5%',
                                                left: 'center'
                                            },
                                            series: [{
                                                name: 'Access From',
                                                type: 'pie',
                                                radius: ['40%', '70%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                    show: false,
                                                    position: 'center'
                                                },
                                                emphasis: {
                                                    label: {
                                                        show: true,
                                                        fontSize: '18',
                                                        fontWeight: 'bold'
                                                    }
                                                },
                                                labelLine: {
                                                    show: false
                                                },
                                                data: [{
                                                        value: data.pending,
                                                        name: 'Pending'
                                                    },
                                                    {
                                                        value: data.paid,
                                                        name: 'Paid'
                                                    },
                                                    {
                                                        value: data.canceled,
                                                        name: 'Canceled',
                                                        itemStyle: {
                                                            color: 'rgb(255, 119, 28)'
                                                        }
                                                    }
                                                ]
                                            }]
                                        });
                                    })
                                    .catch(error => console.error('Error fetching data:', error));
                            });
                        </script>

                    </div>
                </div>
                <!-- End Website Traffic -->




            </div><!-- End Right side columns -->
            <div class="col-lg-12">
                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Blogs</span></h5>

                        <div class="news">

                            @foreach( $blogNews as $blog)
                            <div class="post-item clearfix">
                                <img src="{{ asset('storage/'.$blog->image) }}" style="width: 50px; height: 50px;" alt="">
                                <h4><a href="{{ route('dashboard.blogs.show', $blog->id) }}">{{ $blog->title }}</a></h4>
                                <p>{{ Str::limit($blog->description, 100, '...') }}</p>
                            </div>
                            @endforeach

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->
            </div>

        </div>
    </section>

</main><!-- End #main -->

@endsection