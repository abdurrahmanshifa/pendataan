<script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
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

     var table = $('#table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        info :true,
        ajax: {
            url: "{{ route('survey') }}",
        },
        columns: [
            {"data":"DT_RowIndex"},
            {"data":"ket"},
            {"data":"kelengkapan"},
            {"data":"detail"},
        ],
        columnDefs: [
            {
                targets: [0,-1],
                className: 'text-center'
            },
        ]
    });
</script>