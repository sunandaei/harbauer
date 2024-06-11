@extends('layouts.app')
@section('title', 'Analytical Scheme Data Representation')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h5 style="display: inline-block;">{{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'State' }} : FUNCTIONAL & OFFLINE SCHEMES</h5>
        </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('Result') }}">Home</a></li>
               <li class="breadcrumb-item active">Analytical Scheme Data</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
   <div class="col-md-6">
        <!-- Filter Form -->
        <div class="card">
           <div class="card-header">
              <h3 class="card-title">Filter Results</h3>
           </div>
           <div class="card-body">
              <form method="GET" action="{{ url('/analyticalSchemeData') }}">
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

        <!-- information card -->
        <div class="card">
           <div class="card-header">
              <h3 class="card-title">Distribution Information</h3>
           </div>
           <div class="card-body">
              <div class="row">
                 <div class="col-md-12">
                    <p><strong>Distname:</strong> {{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'State' }}</p>
                    <p><strong>Functional:</strong> {{ $totalFun }}</p>
                    <p><strong>Offline:</strong> {{ $totalOff }}</p>
                 </div>
              </div>
           </div>
        </div>
        <!-- /.card -->

   </div>
   <div class="col-md-6">
     <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $request->district ? $districts->where('dist_code', $request->district)->first()->dist_name : 'State' }} : Functional & Offline Schemes</h3>
        </div>
        <div class="card-body">
            <canvas id="donutChart" style="height: 300px; width: 100%;"></canvas>
        </div>
     </div>
   </div>
</div>
<!-- /.row -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    $(document).ready(function() {
        // Get functional and offline counts
        var totalFun = {{ $totalFun }};
        var totalOff = {{ $totalOff }};

        // Donut Chart data
        var donutData = {
            labels: ['Functional', 'Offline'],
            datasets: [{
                data: [totalFun, totalOff],
                backgroundColor: [
                    '#007bff',
                    '#f33b0f'
                ],
                hoverOffset: 4
            }]
        };

        // Donut Chart options
        var donutOptions = {
            plugins: {
                legend: {
                    display: true
                }
            }
        };

        // Draw the Donut Chart
        var donutChart = new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
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
    #donutChart {
        max-height: 342px;
    }
</style>
