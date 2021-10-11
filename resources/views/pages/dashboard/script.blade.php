<script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
<<<<<<< HEAD
<script>

     var ctx = document.getElementById("myChart2").getContext('2d');
     var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
               labels: [
                    @foreach($data as $val)
                         "{{ $val['klasifikasi'] }}",
                    @endforeach
               ],
               datasets: [{
                    label: 'jumlah',
                    data: [
                         @foreach($data as $val)
                         {{ $val['jml'] }},
                    @endforeach
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                    backgroundColor: '#ffa426',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4,
               }]
          },
          options: {
               legend: {
                    display: false
               },
               scales: {
                    yAxes: [{
                    gridLines: {
                         drawBorder: false,
                         color: '#f2f2f2',
                    },
                    ticks: {
                         beginAtZero: true,
                         stepSize: 150
                    }
                    }],
                    xAxes: [{
                         ticks: {
                              display: true
                         },
                         gridLines: {
                              display: true
                         }
                    }]
               },
          }
     });
=======
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
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166

     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
<<<<<<< HEAD
        info :true,
        ajax: {
            url: "{{ route('survey') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"ket"},
            {"data":"kelengkapan"},
=======
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
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
            {"data":"detail"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });
<<<<<<< HEAD
=======

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
        tickWidth: 1,
        title: {
            text: ''
        },
        lineWidth: 1,
        opposite: true
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
            name: 'Klasifikasi',
            colorByPoint: true,
            data:  [
                        @foreach($data as $val)
                        {
                            name : '{{ $val['klasifikasi'] }}',
                            y : {{ $val['jml'] }},
                            drilldown: '{{ $val['klasifikasi'] }}'
                        },
                        @endforeach
                    ],
        }
    ],

    drilldown: {
        series: [
            @foreach($data as $val)
            {
                name : '{{ $val['klasifikasi'] }}',
                id : '{{ $val['klasifikasi'] }}',
                data: [
                    @foreach($val['kecamatan'] as $vals)
                    [
                        '{{ $vals['id_kec'] }}',
                        {{ $vals['jml'] }}
                    ],
                    @endforeach
                ]
            },
            @endforeach
        ]
    }
   
});

>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
</script>