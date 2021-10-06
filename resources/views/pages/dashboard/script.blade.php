<script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script>

//      var ctx = document.getElementById("myChart2").getContext('2d');
//      var myChart = new Chart(ctx, {
//           type: 'bar',
//           data: {
//                labels: [
//                     @foreach($data as $val)
//                          "{{ $val['klasifikasi'] }}",
//                     @endforeach
//                ],
//                datasets: [{
//                     label: 'jumlah',
//                     data: [
//                          @foreach($data as $val)
//                          {{ $val['jml'] }},
//                     @endforeach
//                     ],
//                     borderWidth: 2,
//                     borderColor: '#fff',
//                     backgroundColor: '#ffa426',
//                     borderWidth: 2.5,
//                     pointBackgroundColor: '#ffffff',
//                     pointRadius: 4,
//                }]
//           },
//           options: {
//                legend: {
//                     display: false
//                },
//                scales: {
//                     yAxes: [{
//                     gridLines: {
//                          drawBorder: false,
//                          color: '#f2f2f2',
//                     },
//                     ticks: {
//                          beginAtZero: true,
//                          stepSize: 150
//                     }
//                     }],
//                     xAxes: [{
//                          ticks: {
//                               display: true
//                          },
//                          gridLines: {
//                               display: true
//                          }
//                     }]
//                },
//           }
//      });

     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :false,
        ajax: {
            url: "{{ route('dashboard') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"klasifikasi"},
            {"data":"lokasi"},
            {"data":"pembangunan"},
            {"data":"status_lahan"},
            {"data":"titik_lokasi"},
            {"data":"detail"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });

Highcharts.chart('myChart2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Survey Menurut Klasifikasi'
    },
    subtitle: {
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
    },

    series: [
        {
            name: 'klasifikasi',
            colorByPoint: true,
            data:  [
                        @foreach($data as $val)
                        {
                            name : '{{ $val['klasifikasi'] }}',
                            y : {{ $val['jml'] }},
                            drilldown: '{{ $val['klasifikasi'] }}'
                        },
                        @endforeach
                    ]
        }
    ],

    drilldown: {
        series: [
            @foreach($data as $val)
            {
                name : '{{ $val['klasifikasi'] }}',
                id : '{{ $val['klasifikasi'] }}',
                data: [
                    @foreach($data_kec as $val)
                    [
                        '{{ $val['id_kec'] }}',
                        {{ $val['jml'] }}
                    ],
                    @endforeach
                ]
            },
            @endforeach
        ]
    }
   
});

</script>