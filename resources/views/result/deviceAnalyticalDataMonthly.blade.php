@extends('layouts.app')
@section('title', 'Device Analytical Data Representation : Monthly')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h5 style="display: inline-block;">{{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'State' }} : IOT Device Details : Monthly</h5>
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

    <!-- Filter Form -->
        <div class="card">
           <div class="card-header">
              <h3 class="card-title">Filter Results</h3>
           </div>
           <div class="card-body">
              <form method="GET" action="{{ url('/deviceAnalyticalDataMonthly') }}">
                 <div class="row">
                    <div class="col-md-12">
                       <select id="district" name="district" class="form-control">
                          <option value="">Select District</option>
                          @foreach($districts as $district)
                          <option value="{{ $district->dist_code }}" {{ $request->district == $district->dist_code ? 'selected' : '' }}>{{ $district->dist_name }}</option>
                          @endforeach
                       </select>
                    </div>
                 </div>
                 <div class="row mt-2">
                    <div class="col-md-12 text-right">
                       <button type="submit" class="btn btn-primary">Find</button>
                    </div>
                 </div>
              </form>
           </div>
        </div>
        <!-- /.card -->




      <!-- /.card -->
      <div class="card">
        
         <!-- /.card-header -->
         <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
               <div class="row">
                  <div class="col-sm-12">
                    <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                 <thead>
                    <tr>
                       <th>Device</th>
                       <th>Nos</th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                       <td>Target Installed Device</td>
                       <td>{{$totalTarInsDevice}}</td>
                    </tr>
                    <tr>
                       <td>Installed IOT Devices</td>
                       <td>{{$totalInsIOTDevice}}</td>
                    </tr>
                    <tr>
                       <td>Functional</td>
                       <td>{{$totalFun}}</td>
                    </tr>
                    <tr>
                       <td>Offline</td>
                       <td>{{$totalOff}}</td>
                    </tr>
                   
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
            <h3 class="card-title">{{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'STATE' }}  IOT DEVICE DETAILS </h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <!-- /bar chart dist wise -->
            <canvas id="barChart" style="height: 450px; width: 100%;"></canvas>
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
<script>
    $(document).ready(function() {
        // Prepare data for the chart
        var deviceNames = ['Target Installed Device', 'Installed IOT Devices', 'Functional', 'Offline'];
        var deviceValues = [
            {{ $barChartData['targetInstalledDevices'] }},
            {{ $barChartData['installedIOTDevices'] }},
            {{ $barChartData['functional'] }},
            {{ $barChartData['offline'] }}
        ];

        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: deviceNames,
                datasets: [{
                    label: 'Device Count',
                    data: deviceValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Devices'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value) {
                            return value;
                        },
                        color: 'black'
                    }
                }
            }
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
