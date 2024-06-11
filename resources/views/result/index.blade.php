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
   <!-- Filter Form -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Filter Results</h3>
        </div>
        <div class="card-body">
          <form method="GET" action="{{ url('/result') }}">
            <div class="row">
                <div class="col-md-2">
                <select id="district" name="district" class="form-control">
                    <option value="">All</option>
                    @foreach($districts as $district)
                       <option value="{{ $district->dist_code }}" {{ $request->district == $district->dist_code ? 'selected' : '' }}>{{ $district->dist_name }}</option>
                 
                    @endforeach
                </select>
               </div>
                <div class="col-md-2">
                   <select id="block" name="block" class="form-control">
                       <option value="">Select Block</option>
                   </select>
                </div>
                <div class="col-md-2">
                    <select id="panchayat" name="panchayat" class="form-control">
                        <option value="">Select Panchayat</option>
                    </select>
                </div>
                <div class="col-md-2">
                <select id="scheme" name="scheme" class="form-control">
                    <option value="">Select scheme</option>
                    @foreach($scheme as $scheme)
                         <option value="{{ $scheme->scheme_id }}" {{ $request->scheme == $scheme->scheme_id ? 'selected' : '' }}>{{ $scheme->scheme_name }}</option>
                    
                    @endforeach
                </select>
               </div>
                <div class="col-md-2">
                    <select id="scheme_type" name="scheme_type" class="form-control">
                        <option value="">Select scheme type</option>
                        <option value="PWS" {{ $request->scheme_type == 'PWS' ? 'selected' : '' }}>PWS</option>
                        <option value="WLS" {{ $request->scheme_type == 'WLS' ? 'selected' : '' }}>WLS</option>
                    
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="status" name="status" class="form-control">
                        <option value="">Select status</option>
                        <option value="FUNCTIONAL" {{ $request->status == 'FUNCTIONAL' ? 'selected' : '' }}>FUNCTIONAL</option>
                        <option value="OFFLINE" {{ $request->status == 'OFFLINE' ? 'selected' : '' }}>OFFLINE</option>
                    
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
<script>
$(document).ready(function() {
// Store the previous selections
var previousDistrict = "{{ isset($request) ? $request->district : '' }}";
var previousBlock = "{{ isset($request) ? $request->block : '' }}";

var previousPanchayat = "{{ isset($request) ? $request->panchayat : '' }}";


// Function to populate the blocks dropdown based on the selected district
function populateBlocks(district_id) {
$('#block').empty().append('<option value="">Select Blocks</option>');
    if (district_id) {
        $.ajax({
            url: '{{ url("/get-blocks") }}',
            type: 'GET',
                data: { dist_code: district_id },
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#block').append('<option value="'+ value.block_code +'">'+ value.block_name +'</option>');
                    });

                    // Set the previously selected block
                    $('#block').val(previousBlock);

                    // Populate the panchayats based on the selected block
                    populatePanchayats(previousBlock);
                }
            });
        }
    }

    // Function to populate the panchayats dropdown based on the selected block
    function populatePanchayats(block_id) {
        $('#panchayat').empty().append('<option value="">Select Panchayat</option>');
        if (block_id) {
            $.ajax({
                url: '{{ url("/get-panchayats") }}',
                type: 'GET',
                data: { block_code: block_id },
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#panchayat').append('<option value="'+ value.pan_code +'">'+ value.pan_name +'</option>');
                    });

                    // Set the previously selected panchayat
                    $('#panchayat').val(previousPanchayat);
                }
            });
        }
    }
// Initialize the dropdowns with previous selections
$('#district').val(previousDistrict);
// Populate blocks and panchayats based on previous selections
populateBlocks(previousDistrict);

$('#district').change(function() {
        var district_id = $(this).val();
        populateBlocks(district_id);
    });

$('#block').change(function() {
        var block_id = $(this).val();
        populatePanchayats(block_id);
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
</style>
