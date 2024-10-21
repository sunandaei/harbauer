<!-- resources/views/portfolio/index.blade.php -->
@extends('layouts.app')
@section('title', 'Water quality result')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 style="display: inline-block;">Upload data</h1>
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
   

    <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Result Uplaod</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                                  <div class="col-sm-12">
                                     @if ($errors->any())
                                        <div>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('uploadExcel') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="excel_file">Select Excel File:</label>
                                        <input type="file" name="excel_file" required>
                                        <button type="submit">Upload</button>
                                    </form>
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
