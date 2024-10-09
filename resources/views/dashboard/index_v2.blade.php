@extends('layouts.master')

@section('content')

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
            <div class="row">
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-ver bg-secondary">
                                <div class="card-body people" style="cursor:pointer">
                                    <div class="img">
                                        <img src="{{ asset('assets/img/team.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">All Supplier</span>
                                        <span id="allSupplier" class="value">0</span>
                                        <!-- <span class="detail_card_dashboard">Detail</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 margin-top-card-custom">
                            <div class="card card-ver bg-danger">
                                <div class="card-body people" style="cursor:pointer">
                                    <div class="img">
                                        <img src="{{ asset('assets/img/out-of-stock.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Shortage</span>
                                        <span id="shortageStockSupplier" class="value counting">3</span>
                                        <span class="detail_card_dashboard">Supplier</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 margin-top-card-custom">
                            <div class="card card-ver bg-warning">
                                <div class="card-body vehicle" style="cursor:pointer">
                                    <div class="img">
                                        <img src="{{ asset('assets/img/box-warning.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Potential</span>
                                        <span id="PotentialStockSupplier" class="value counting">10</span>
                                        <span class="detail_card_dashboard">Supplier</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 margin-top-card-custom">
                            <div class="card card-ver bg-success">
                                <div class="card-body document" style="cursor:pointer">
                                    <div class="img">
                                        <img src="{{ asset('assets/img/product.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Safe Stock</span>
                                        <span id="safetyStockSupplier" class="value counting">7</span>
                                        <span class="safetyStockSupplier">Supplier</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-3 margin-left-card-custom">
                            <div class="card card-ver card-ver3 bg-secondary">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/car-parts.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">All Part</span>
                                        <span id="allParts" class="value">0</span>
                                        <!-- <span class="detail_card_dashboard">Detail</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 margin-left-card-custom">
                            <div class="card card-ver card-ver3 bg-danger">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/out-of-stock.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Shortage Stock</span>
                                        <span id="shortageStock_part" class="value">0</span>
                                        <span class="detail_card_dashboard">Part</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 margin-left-card-custom">
                            <div class="card card-ver card-ver3 bg-warning">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/box-warning.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Potential Stock</span>
                                        <span id="PotentialStock_part" class="value">0</span>
                                        <span class="detail_card_dashboard">Part</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 margin-left-card-custom">
                            <div class="card card-ver card-ver3 bg-success">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/product.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Safe Stock</span>
                                        <span id="SafetyStock_part" class="value">0</span>
                                        <span class="detail_card_dashboard">Part</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top-card-custom">
                        <div class="col-lg-12 margin-left-card-custom">
                            <div class="card" style="height: 260px;">
                                <div class="card-body">
                                    <div class="table-responsive" id="autoScrollTable" style="max-height: 200px; overflow-y: auto;">
                                        <table class="table table-hover table-bordered auto-scroll-row">
                                            <thead>
                                                <tr style="position: sticky; top: 0; background-color: white; z-index: 1;">
                                                    <th>Supplier</th>
                                                    <th>Part Number</th>
                                                    <th>Part Name</th>
                                                    <th>Stock</th>
                                                    <th>Status</th>
                                                    <th>Lates Update</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableStock">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="jqGridPager"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row margin-top-card-custom">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">
                                    </div>
                                    <div id="persentaseStock"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">
                                    </div>
                                    <div id="persentaseStockBySupp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        // Function to change the value with a smooth effect
        function updateCounter() {
            const display = document.getElementById("shortageStockSupplier");

            // Apply fade out effect first
            display.classList.add("changing");
            const newValue = Math.floor(Math.random() * 100);
            // After a short delay, update the value and apply fade in effect
            setTimeout(function() {
                currentValue = newValue;
                display.innerHTML = currentValue;
                // Change the style to the new value (fading back in and changing color)
                display.classList.remove("changing");
                display.classList.add("changed");

                // Remove the changed class after the transition
                setTimeout(function() {
                    display.classList.remove("changed");
                }, 500); // 0.5s matches the transition time in CSS
            }, 300); // Wait for 0.3s to match the fade-out effect
        }

        function refreshDashboard() {
            updateCounter()
        }

        /* View Full Screen */
        var elem = document.getElementById("dashboardForm");

        function openFullscreen() {
            $("#dashboardForm").css("background", "#f9fbfd");
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE/Edge */
                elem.msRequestFullscreen();
            }
        }

        var idGraph = ['persentaseStock', 'persentaseStockBySupp'];
        var types = ['Part', 'Supplier'];
        var titleGraph = ['Stock Update Today By Part', 'Stock Update Today By Supplier']

        for (let j = 0; j < idGraph.length; j++) {
            Highcharts.chart(idGraph[j], {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        // alpha: 45,
                        beta: 0
                    }
                },
                credits: {
                    enabled: false
                },
                exporting: {
                    enabled: false
                },
                title: {
                    // text: ' ',
                    text: titleGraph[j],
                    align: 'center'
                },
                subtitle: {
                    text: 'Source: ' +
                        'Data From Supplier',
                    // text: ' ',
                    align: 'center'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    // pie: {
                    //     allowPointSelect: true,
                    //     cursor: 'pointer',
                    //     depth: 35,
                    //     dataLabels: {
                    //         enabled: false,
                    //         format: '{point.name} : {point.percentage:.1f}%'
                    //     },
                    //     size: 200
                    // }
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        borderRadius: 8,
                        dataLabels: [{
                            enabled: false,
                            distance: 20,
                            format: '{point.name}'
                        }, {
                            enabled: true,
                            distance: -15,
                            format: '{point.y}',
                            style: {
                                fontSize: '0.9em'
                            }
                        }],
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Total',
                    enabled: true,
                    data: [{
                            name: types[j] + ' Has Update',
                            y: 12,
                            sliced: true,
                            selected: true,
                            color: '#31ce36'
                        },
                        {
                            name: types[j] + ' Not Update',
                            y: 15,
                            color: '#f25961'
                        }
                    ]
                }]
            });
        }

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


        function startCountdown(duration, display) {
            var timer = duration,
                minutes, seconds;
            var countdownInterval = setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes;
                seconds = seconds;

                display.textContent = 'Refresh ' + minutes + " m " + seconds + ' s ';
                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    display.textContent = "Time's up!";
                    // location.reload();
                }
            }, 1000);
        }

        window.onload = function() {

            var twoMinutes = $("#refreshDashboardTimer").val() * 60, // 2 minutes in seconds
                display = document.getElementById('btnRefresh');
            startCountdown(twoMinutes, display);
        };


        function jsonAllPart() {
            $.ajax({
                url: "{{ url('jsonAllPart') }}",
                method: "GET",
                cache: false,
                success: function(res) {
                    $("#allParts").html(res)
                }
            })
        }

        function jsonAllSupplier() {
            $.ajax({
                url: "{{ url('jsonAllSupplier') }}",
                method: "GET",
                cache: false,
                success: function(res) {
                    $("#allSupplier").html(res)
                }
            })
        }

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
                        html += `<td>${res[i].last_update == null ? '-' : res[i].last_update }</td>`
                        html += `</tr>`
                    }
                    if (res.length > 5) {
                        autoScrollTable()
                    }
                    $("#tableStock").html(html);
                }
            })
        }

        function jsonStockPart(type, status) {
            $.ajax({
                url: "{{ url('jsonStockPart') }}",
                method: "GET",
                cache: false,
                data: {
                    types: type
                },
                success: function(res) {
                    $("#" + status + "_part").html(res)
                }
            })
        }


        jsonAllPart()
        jsonStockPart("SHORTAGE", "shortageStock")
        jsonStockPart("POTENTIAL", "PotentialStock")
        jsonStockPart("SAFETY", "SafetyStock")
        jsonAllSupplier()
        jsonTableStock()
    </script>

    @endsection