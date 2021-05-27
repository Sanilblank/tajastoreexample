@extends('backend.layouts.app')
@push('styles')
    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="right_col" role="main">

            <h4 class="p-3">Dashboard</h4>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><font size=10px>{{count($users)}}</font> Active Users</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div> --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><font size=10px>{{count($vendors)}}</font> Total Vendors</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div> --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><font size=10px>{{count($allproducts)}}</font> Products</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-pie-chart fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            {{-- <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div> --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><font size=10px>{{$ordertodaycount}}</font> Orders Today</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-shopping-basket fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            {{-- Pie Chart --}}
            <div class="col-xl-4 col-lg-4 p-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-3" style="font-weight: bold">Most Frequent Buyers of Year: {{date('Y')}}</h5>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="pie_basic"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bar Chart --}}
            <div class="col-xl-8 col-lg-8 p-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-3" style="font-weight: bold">New Registered Users For Year: {{date('Y')}}</h5>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="bars_basic"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Line Chart --}}
            <div class="col-xl-12 col-lg-12 p-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-3" style="font-weight: bold">Total Orders for Year: {{date('Y')}}</h5>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="line_stacked"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Line Chart Second --}}
            <div class="col-xl-12 col-lg-12 p-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-3" style="font-weight: bold">Sales, Expenses and Profit For Year: {{date('Y')}} (in Rs.)</h5>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="line_stacked2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>

    <script type="text/javascript">
        var bars_basic_element = document.getElementById('bars_basic');
        if (bars_basic_element) {
            var bars_basic = echarts.init(bars_basic_element);
            bars_basic.setOption({
                color: ['#2ec7c9'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '3%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        data: [
                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
                        ],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: 'Total New Users',
                        type: 'bar',
                        barWidth: '50%',
                        data: [
                            {{$newusers[0]}},
                            {{$newusers[1]}},
                            {{$newusers[2]}},
                            {{$newusers[3]}},
                            {{$newusers[4]}},
                            {{$newusers[5]}},
                            {{$newusers[6]}},
                            {{$newusers[7]}},
                            {{$newusers[8]}},
                            {{$newusers[9]}},
                            {{$newusers[10]}},
                            {{$newusers[11]}},
                        ]
                    }
                ]
            });
        }
        </script>

<script type="text/javascript">
    var pie_basic_element = document.getElementById('pie_basic');
    if (pie_basic_element) {
        var pie_basic = echarts.init(pie_basic_element);
        pie_basic.setOption({
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
            ],

            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 13
            },
            title: {
                text: 'Users with most orders',
                left: 'center',
                textStyle: {
                    fontSize: 18,
                    fontWeight: 700
                },
                subtextStyle: {
                    fontSize: 12
                }
            },

            tooltip: {
                trigger: 'item',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            legend: {
                orient: 'horizontal',
                bottom: '0%',
                left: 'center',
                data: ['{{$frequentusersname[0]}}', '{{$frequentusersname[1]}}', '{{$frequentusersname[2]}}', '{{$frequentusersname[3]}}', '{{$frequentusersname[4]}}'],
                itemHeight: 8,
                itemWidth: 8
            },

            series: [{
                name: 'No of orders',
                type: 'pie',
                radius: '70%',
                center: ['50%', '50%'],
                itemStyle: {
                    normal: {
                        borderWidth: 1,
                        borderColor: '#fff'
                    }
                },
                data: [
                    {value: {{$frequentusersorders[0]}}, name: '{{$frequentusersname[0]}}'},
                    {value: {{$frequentusersorders[1]}}, name: '{{$frequentusersname[1]}}'},
                    {value: {{$frequentusersorders[2]}}, name: '{{$frequentusersname[2]}}'},
                    {value: {{$frequentusersorders[3]}}, name: '{{$frequentusersname[3]}}'},
                    {value: {{$frequentusersorders[4]}}, name: '{{$frequentusersname[4]}}'},
                ]
            }]
        });
    }
    </script>

    <script type="text/javascript">
        var line_stacked_element = document.getElementById('line_stacked');
        if (line_stacked_element) {
            var line_stacked = echarts.init(line_stacked_element);
            line_stacked.setOption({
                animationDuration: 750,
                grid: {
                    left: 0,
                    right: 20,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },
                legend: {
                    data: ['Orders'],
                    itemHeight: 8,
                    itemGap: 20
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
                    ],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'No of Orders',
                        type: 'line',

                        smooth: true,
                        symbolSize: 7,
                        data: [
                            {{$totalorders[0]}},
                            {{$totalorders[1]}},
                            {{$totalorders[2]}},
                            {{$totalorders[3]}},
                            {{$totalorders[4]}},
                            {{$totalorders[5]}},
                            {{$totalorders[6]}},
                            {{$totalorders[7]}},
                            {{$totalorders[8]}},
                            {{$totalorders[9]}},
                            {{$totalorders[10]}},
                            {{$totalorders[11]}}
                                ],
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        }
                    },

                ]
            });
        }
        </script>

<script type="text/javascript">
    var line_stacked_element = document.getElementById('line_stacked2');
    if (line_stacked_element) {
        var line_stacked = echarts.init(line_stacked_element);
        line_stacked.setOption({
            animationDuration: 750,
            grid: {
                left: 0,
                right: 20,
                top: 35,
                bottom: 0,
                containLabel: true
            },
            legend: {
                data: ['Sales (Rs.)', 'Expense (Rs.)', 'Profit (Rs.)'],
                itemHeight: 8,
                itemGap: 20
            },

            // Add tooltip
            tooltip: {
                trigger: 'axis',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                }
            },

            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
                ],
                axisLabel: {
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                }
            }],

            // Vertical axis
            yAxis: [{
                type: 'value',
                axisLabel: {
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                },
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                    }
                }
            }],

            // Add series
            series: [
                {
                    name: 'Sales (Rs.)',
                    type: 'line',

                    smooth: true,
                    symbolSize: 7,
                    data: [
                        {{$totalincome[0]}},
                        {{$totalincome[1]}},
                        {{$totalincome[2]}},
                        {{$totalincome[3]}},
                        {{$totalincome[4]}},
                        {{$totalincome[5]}},
                        {{$totalincome[6]}},
                        {{$totalincome[7]}},
                        {{$totalincome[8]}},
                        {{$totalincome[9]}},
                        {{$totalincome[10]}},
                        {{$totalincome[11]}}
                            ],
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
                {
                    name: 'Expense (Rs.)',
                    type: 'line',

                    smooth: true,
                    symbolSize: 7,
                    data: [
                        {{$totalexpense[0]}},
                        {{$totalexpense[1]}},
                        {{$totalexpense[2]}},
                        {{$totalexpense[3]}},
                        {{$totalexpense[4]}},
                        {{$totalexpense[5]}},
                        {{$totalexpense[6]}},
                        {{$totalexpense[7]}},
                        {{$totalexpense[8]}},
                        {{$totalexpense[9]}},
                        {{$totalexpense[10]}},
                        {{$totalexpense[11]}}
                            ],
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
                {
                    name: 'Profit (Rs.)',
                    type: 'line',

                    smooth: true,
                    symbolSize: 7,
                    data: [
                        {{$totalprofit[0]}},
                        {{$totalprofit[1]}},
                        {{$totalprofit[2]}},
                        {{$totalprofit[3]}},
                        {{$totalprofit[4]}},
                        {{$totalprofit[5]}},
                        {{$totalprofit[6]}},
                        {{$totalprofit[7]}},
                        {{$totalprofit[8]}},
                        {{$totalprofit[9]}},
                        {{$totalprofit[10]}},
                        {{$totalprofit[11]}}
                            ],
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
            ]
        });
    }
    </script>
@endpush
