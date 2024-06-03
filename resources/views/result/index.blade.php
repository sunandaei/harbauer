<!-- resources/views/portfolio/index.blade.php -->
@extends('layouts.app')
@section('title', 'Water quality result')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 style="display: inline-block;">Result</h1>
        </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('Result') }}">Home</a></li>
               <li class="breadcrumb-item active">Result</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Result Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">


                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th>Dist Name</th>
                      <th>Block Name</th>
                      <th>Pan Name</th>
                      <th>Ward</th>
                      <th>Scheme Name</th>
                      <th>Scheme Id</th>
                      <th>Scheme Type</th>
                      <th>Device Id</th>
                      <th>Status</th>
                      <th>Avg Motor Running Hrs</th>
                      <th>Elec. Avi Staus</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $index => $item)

                    <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                       <td>{{ $item->dist_name }}</td>
                       <td>{{ $item->block_name}}</td>
                       <td>{{ $item->pan_name }}</td>
                       <td>{{ $item->ward }}</td>
                       <td>{{ $item->scheme_name }}</td>
                       <td>{{ $item->scheme_id }}</td>
                       <td>{{ $item->scheme_type }}</td>
                       <td>{{ $item->device_id }}</td>
                       <td>{{ $item->status }}</td>
                       <td>{{ $item->motor_running_hrs }}</td>
                       <td>{{ $item->elec_avi }}</td>
                      
                     </tr>
                    @endforeach
                  </tbody>
                  
                </table>
             </div>
          </div>




             </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
@endsection

@push('scripts')

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
</style>
