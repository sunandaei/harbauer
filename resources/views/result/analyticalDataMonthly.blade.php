@extends('layouts.app')
@section('title', 'Analytical Data Representation : Monthly')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h5 style="display: inline-block;">{{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'State' }} : Analytical Data Representation : Monthly</h5>
        </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('Result') }}">Home</a></li>
               <li class="breadcrumb-item active">Analytical Data Representation : Monthly</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
   <div class="col-6">

   <div class="col-12">
      <!-- /.card -->
      <div class="card">
         <div class="card-header">
            <h3 class="card-title"></h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
               <div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                 <thead>
                    <tr>
                       <th>District Code</th>
                       <th>Average Motor Running Hours</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($data as $item)
                    <tr>
                       <td>{{$item[0]}}</td>
                       <td>{{ number_format($item[1], 2) }}</td>
                    </tr>
                    @endforeach
                 </tbody>
              </table>
                  </div>
               </div>
               <!-- /.row -->
            </div>
            <!-- /.dataTables_wrapper dt-bootstrap4 -->
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.col -->

   </div>
   <!-- /.col 1st col end -->

   <div class="col-6">
    <div class="col-12">
       <!-- /.card -->
        <div class="card">
         <div class="card-header">
            <h3 class="card-title">DISTRICT-WISE AVERAGE MOTOR RUNNING (HOURS) </h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <!-- /bar chart dist wise -->
            <canvas id="barChart" style="height: 400px; width: 100%;"></canvas>
         </div>
         <!-- /.card-body -->
        </div>   
        <!-- /.card -->
    </div>
    <!-- /.col-12 -->
   </div>
   <!-- /.col 2nd col end-->



</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    $(document).ready(function() {
        // Prepare data for the chart
        var districtNames = {!! json_encode(array_column($data, 0)) !!};
        var avgMotorRunningHrs = {!! json_encode(array_column($data, 1)) !!};

        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: districtNames,
                datasets: [{
                    label: 'Average Motor Running Hours',
                    data: avgMotorRunningHrs,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Districts'
                        }
                    },
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Average Motor Running Hours'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value) {
                            return value.toFixed(2);
                        },
                        color: 'black'
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>
@endpush

<style>
    /* Align buttons to the right */
    .d-flex.justify-content-end.align-items-center {
        justify-content: flex-end;
    }
    
    /* Add gap between buttons */
    .d-flex.justify-content-end.align-items-center .btn {
        margin-left: 5px; /* Adjust as needed */
    }

    /* Add margin to avoid overlapping */
    .card-body {
        margin-bottom: 20px;
    }

    /* Ensure the canvas is responsive and not too tall */
    
</style>
