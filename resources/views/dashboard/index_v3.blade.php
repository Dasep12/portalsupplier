@extends('layouts.master')

@section('content')

<style>

</style>
<div class="main-panel">
    <div class="content">
        <div class="row" style="position: relative;top:0;display:flex;">
            <div class="col-lg-12">
                <div class="row d-flex justify-content-end align-items-center bg-white p-2 shadow">
                    <!-- Dashboard icon -->
                    <a href="#" class="nav-link mr-auto ml-4">
                        <i class="icon-home"></i> Dashboard
                    </a>

                    <!-- Fullscreen button -->
                    <a href="#" onclick="openFullscreen()" class="nav-link">
                        <i class="icon-size-fullscreen"></i>
                    </a>

                    <!-- Dropdown button -->
                    <div class="dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle" id="btnRefresh" data-target="form-timer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Refresh 0 m 0 s
                        </a>

                        <!-- Dropdown menu -->
                        <form id="form-timer" aria-labelledby="btnRefresh" class="dropdown-menu dropdown-menu-right p-4 shadow-sm rounded-0" style="width:320px">
                            <div class="form-group">
                                <label for="refreshDashboardTimer" class="col-form-label col-form-label-sm">Reload Dashboard Timer (In Minutes)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="refreshDashboardTimer" class="form-control" placeholder="Dashboard timer" value="1" min="1" max="60" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Apply button -->
                            <a id="btnApply" href="#" class="nav-link text-right" onclick="refreshDashboard()">
                                <span class="icon-check"></span> Apply Now
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner" id="dashboardForm">
            <!-- content -->

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-dark">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right">
                                <img src="https://cdn-icons-png.flaticon.com/128/16133/16133264.png" alt="" style="height: 80px;">
                            </div>
                            <h1 style="color:black" class="mb-2">17</h1>
                            <h1 style="color:black">Total Supplier</h1>
                            <div class="pull-in sparkline-fix chart-as-background">
                                <div id="lineChart"><canvas style="display: inline-block; width: 304px; height: 70px; vertical-align: top;" width="304" height="70"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right">
                                <img src="https://cdn-icons-png.flaticon.com/128/7183/7183999.png" alt="" style="height: 80px;">
                            </div>
                            <h1 style="color:black" class="mb-2">27</h1>
                            <h1 style="color:black">Total Category</h1>
                            <div class="pull-in sparkline-fix chart-as-background">
                                <div id="lineChart2"><canvas style="display: inline-block; width: 304px; height: 70px; vertical-align: top;" width="304" height="70"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right">
                                <img src="https://cdn-icons-png.flaticon.com/128/12622/12622106.png" alt="" style="height: 80px;">
                            </div>
                            <h1 style="color:black" class="mb-2">213</h1>
                            <h1 style="color:black">Total Part</h1>
                            <div class="pull-in sparkline-fix chart-as-background">
                                <div id="lineChart3"><canvas style="display: inline-block; width: 304px; height: 70px; vertical-align: top;" width="304" height="70"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-xxl-6">
                    <div class="card" style="height: 300px;">
                        <div id="pieChart" style="height: 100%;"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-6">
                    <div class="card" style="height: 300px;">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xxl-12">
                    <div class="card" style="height: 300px;">
                        <div class="card-body">

                            <div class="" id="autoScrollTable" style="max-height: 280px; overflow-y: auto;">
                                <table class="table auto-scroll-row">
                                    <thead>
                                        <tr style="position: sticky; top: 0; background-color: white; z-index: 1;">
                                            <th>Supplier</th>
                                            <th>Part Number</th>
                                            <th>Part Name</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableStock">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end  -->
        </div>
    </div>
</div>
<script src="https://fastly.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<script>
    Highcharts.chart('pieChart', {
        chart: {
            backgroundColor: null,
            type: 'pie',
            custom: {},
            events: {
                render() {
                    const chart = this,
                        series = chart.series[0];
                    let customLabel = chart.options.chart.custom.label;

                    if (!customLabel) {
                        customLabel = chart.options.chart.custom.label =
                            chart.renderer.label(
                                'Total<br/>' +
                                '<strong>213</strong>'
                            )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                    }

                    const x = series.center[0] + chart.plotLeft,
                        y = series.center[1] + chart.plotTop -
                        (customLabel.attr('height') / 2);

                    customLabel.attr({
                        x,
                        y
                    });
                    // Set font size based on chart diameter
                    customLabel.css({
                        fontSize: `${series.center[2] / 12}px`
                    });
                }
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        title: {
            text: ''
        },
        subtitle: {
            text: '<span style="color: black;font-weight:700; font-size: 16px;">Control Stock By Part</span>',
            useHTML: true
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                borderRadius: 8,
                dataLabels: [{
                    enabled: true,
                    distance: 20,
                    format: '{point.name} ( {point.y} )'
                }, {
                    enabled: true,
                    distance: -15,
                    format: '{point.percentage:.0f}%',
                    style: {
                        fontSize: '0.9em'
                    }
                }],
                showInLegend: true
            }
        },
        series: [{
            name: '',
            colorByPoint: true,
            innerSize: '55%',
            data: [{
                name: 'Shortage',
                y: 250,
                color: 'red'
            }, {
                name: 'Potential',
                y: 21,
                color: 'orange'
            }, {
                name: 'Safety',
                y: 1000,
            }]
        }]
    });

    // Automatic scrolling function
    function autoScrollTable() {
        var table = document.getElementById('autoScrollTable');
        var scrollStep = 1; // Speed of scroll
        var scrollInterval = 50; // Time interval between scrolls (in ms)

        setInterval(function() {
            if (table.scrollTop + table.clientHeight >= table.scrollHeight) {
                table.scrollTop = 0; // Reset scroll when reaching the bottom
            } else {
                table.scrollTop += scrollStep; // Scroll down by step
            }
        }, scrollInterval);
    }

    autoScrollTable()

    function jsonTableStock() {
        $.ajax({
            url: "{{ url('jsonTableStock') }}",
            method: "GET",
            cache: false,
            success: function(res) {
                var html = '';
                for (let i = 0; i < res.length; i++) {
                    var badge = res[i].stockStatus == "SHORTAGE" ? "badge-danger" : "badge-success";
                    html += `<tr>`
                    html += `<td>${res[i].supplier_name}</td>`
                    html += `<td>${res[i].part_number}</td>`
                    html += `<td>${res[i].part_name}</td>`
                    html += `<td>${res[i].stockSupplier}</td>`
                    html += `<td><label class="text-white badge ${badge}" for="">${res[i].stockStatus}</label></td>`
                    html += `</tr>`
                }
                if (res.length > 5) {
                    autoScrollTable()
                }
                $("#tableStock").html(html);
            }
        })
    }
    jsonTableStock()
</script>
@endsection