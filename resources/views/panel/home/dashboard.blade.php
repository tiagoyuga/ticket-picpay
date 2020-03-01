@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content animated fadeIn">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Cadastro de usuário por dia')
                        @component('panel._components.input_datepicker_range', ['id' => 'users_registration_day_period'])@endcomponent
                    @endcomponent
                    <div class="ibox-content">
oi
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')

@endsection

@section('scripts')

    @include('panel._assets.scripts-daterangepicker')
    @include('panel._assets.scripts-highcharts')

    <script>
        Highcharts.setOptions({
            lang: {
                months: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril',
                    'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ],
                shortMonths: [
                    'Jan', 'Fev', 'Mar', 'Abr',
                    'Mai', 'Jun', 'Jul', 'Ago',
                    'Set', 'Out', 'Nov', 'Dez'
                ],
            }
        });

        var dateEnd = moment("{{ \Illuminate\Support\Carbon::now()->addMonth()->format('Ymd') }}", "YYYYMMDD");

        inputDatePickerRange("#users_registration_day_period", false, dateEnd);

        $(function () {
            drawChart_users_registration_day();

            $(".filter").change(function (e) {
                (new Function($(this).attr("data-callback") + "()"))()
            });

            $("#users_registration_day_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_users_registration_day();
            });

        });

        function drawChart_users_registration_day() {

            block("#users_registration_day");

            $.getJSON('{{ route('report.users.userRegistration') }}', {
                period: $("#users_registration_day_period").val(),
            })
                .done(function (result) {
                    let series = result.data.map(item => [Date.UTC(item.year, item.month - 1, item.day), item.count]);
                    Highcharts.chart('users_registration_day', {

                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'datetime',
                            dateTimeLabelFormats: {
                                month: '%e. %b',
                                year: '%b'
                            },
                            title: {
                                text: 'Dias'
                            },
                        },
                        yAxis: {
                            title: {
                                text: 'Número de usuários'
                            },
                            min: 0
                        },
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.x:%e. %b}: <b>{point.y}</b> usuários(s)'
                        },

                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: true
                                }
                            }
                        },

                        colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                        series: [{
                            name: $("#users_registration_day_period").val(),
                            data: series
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    plotOptions: {
                                        series: {
                                            marker: {
                                                radius: 2.5
                                            }
                                        }
                                    }
                                }
                            }]
                        }
                    });
                })
                .always(function () {
                    unBlock('#users_registration_day');
                });
        }

    </script>

@endsection
