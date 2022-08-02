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
        info :true,
        ajax: {
            url: "{{ route('dashboard') }}",
            data: function (data) {
                data.filter = {
                        'tahun' : $('[name="filter_tahun"]').val(),
                        'kec'    : $('[name="filter_kec"]').val(),
                        'kel'   : $('[name="filter_kel"]').val(),
                        'kla'   : $('[name="filter_kla"]').val(),
                        'stat'   : $('[name="filter_stat"]').val(),
                };
            }
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"klasifikasi"},
            {"data":"lokasi"},
            {"data":"pembangunan"},
            {"data":"status_lahan"},
            {"data":"detail"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });

    function table_data(){
        table.ajax.reload(null,true);
    }

    $('[name="filter_tahun"]').keyup(delay(function (e) {
        table_data();
    }, 9000));

    $("[name='id_kec']").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data){
                    $('[name="id_kel"]').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
            }
        });
     });

     $("[name='filter_kec']").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "{{url('master/kelurahan/id-by-kec/')}}"+"/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data){
                    $('[name="filter_kel"]').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
            }
        });
        table_data();
     });
     $("[name='filter_kla']").change(function(){
        table_data();
     });
     $("[name='filter_kel']").change(function(){
        table_data();
     });
     $("[name='filter_stat']").change(function(){
        table_data();
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
        tickWidth: 1,
        title: {
            text: ''
        },
        lineWidth: 1,
        opposite: true,
        scrollbar: {
            enabled: true
        },
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

</script>