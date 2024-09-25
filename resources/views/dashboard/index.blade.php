@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-ver card-primary">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/car-parts.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">All Part</span>
                                        <span id="shortageStock" class="value">20</span>
                                        <span class="detail_card_dashboard">Detail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-ver card-danger">
                                <div class="card-body people" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">

                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/out-of-stock.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Shortage</span>
                                        <span id="shortageStock" class="value">3</span>
                                        <span class="detail_card_dashboard">Detail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-ver card-warning">
                                <div class="card-body vehicle" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">
                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/box-warning.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Potential Shortage</span>
                                        <span id="vehicleTotal" class="value">10</span>
                                        <span class="detail_card_dashboard">Detail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-ver card-success">
                                <div class="card-body document" style="cursor:pointer">
                                    <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">
                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('assets/img/product.png') }}">
                                    </div>
                                    <div class="text">
                                        <span class="title">Safety Stock</span>
                                        <span id="materialTotal" class="value">7</span>
                                        <span class="detail_card_dashboard">Detail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card" style="height: 530px;">
                        <!-- <div class="card-header">
                            <h5></h5>
                        </div> -->
                        <div class="card-body">
                            <div style="position: absolute;left:50%;top:40%" class="row justify-content-center">
                            </div>
                            <div id="persentaseStock"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    Highcharts.chart('persentaseStock', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
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
            text: 'Persentase Stock Today',
            align: 'center'
        },
        subtitle: {
            text: 'Source: ' +
                'Data From Supplier',
            align: 'center'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name} : {point.percentage:.1f}%'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: [{
                    name: 'Shortage',
                    y: 12,
                    sliced: true,
                    selected: true,
                    color: '#f25961'
                },
                {
                    name: 'Potential Shortage',
                    y: 15,
                    color: '#ffad46'
                },
                {
                    name: 'Safety Stock',
                    y: 50,
                    color: '#31ce36'
                }
            ]
        }]
    });
</script>

@endsection