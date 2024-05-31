<!-- resources/views/portfolio/index.blade.php -->
@extends('layouts.app')
@section('title', 'Portfolio')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 style="display: inline-block;">My Portfolio</h1>
             <button class="btn btn-success mb-2" id="createPortfolio" style="display: inline-block; margin-left: 10px;">Create</button>
        
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active">Portfolio</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>

            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="card-header">
                <h3 class="card-title">Portfolio Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <caption>
                    Council budget (in £) 2018
                </caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>p&l</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($activPort as $pkey => $pItem)

                  <tr data-widget="expandable-table" aria-expanded="false" id="portfolio_{{ $pItem->id }}">
                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                      <span>{{$pItem->name}}</span>
                      
                  </div>  
              </td>
              <td>&nbsp;</td>
              <td>
              <div class="d-flex justify-content-end align-items-center">
              <!-- Button to add position -->
              <button class="btn btn-primary btn-sm add-position" data-pitemid="{{$pItem->id}}" data-toggle="modal" data-target="#addPositionModal">Add Position</button>
              <!-- Button to toggle portfolio activation/deactivation -->
              @if($pItem->active)
              <button class="btn btn-warning btn-sm toggle-portfolio" data-portfolio-id="{{$pItem->id}}" data-action="deactivate">Deactive</button>
              @else
              <button class="btn btn-success btn-sm toggle-portfolio" data-portfolio-id="{{$pItem->id}}" data-action="activate">Active</button>
              @endif
              <!-- Button to edit portfolio -->
              <button class="btn btn-primary btn-sm edit-portfolio" data-portfolio-id="{{ $pItem->id }}" data-toggle="modal" data-target="#editPortfolioModal">Edit</button>

              </div>
              </td>
            </tr>
            <tr class="expandable-body" id="portfolio_details_{{ $pItem->id }}">
            <td colspan="3">
            <p>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>script</th>
      <th>expiry</th>
      <th>action</th>
      <th>option</th>
      <th>strick Price</th>
      <th>Action</th>
    </tr>
    
  </thead>
  <tbody>
    @foreach($pItem->positions as $position)
      <tr>
        <td>{{$position->script}}</td>
        <td>{{$position->expiry}}</td>
        <td>{{$position->action}}</td>
        <td>{{$position->option}}</td>
        <td>{{$position->strickOption}}</td>

        <td>
          <button class="btn btn-primary btn-sm edit-position" data-position-id="{{ $position->id }}" data-script="{{ $position->script }}" data-segment="{{ $position->segment}}" data-expiry="{{ $position->expiry}}" data-action="{{ $position->action}}" data-option="{{ $position->option}}" data-option="{{ $position->option}}" data-portfolio_id="{{ $position->portfolio_id}}" data-toggle="modal" data-target="#editPositionModal">Edit</button>
        </td>

      </tr>
    @endforeach
  </tbody>
</table>
                      </p>
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
                <tfoot>
                     <tr>
                        <th scope="row">Totals</th>
                        <td>21,000</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
              </table>
            </div>
        </div>
    </div>
</div>  
         
<div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Portfolio Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">


                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $index => $item)

                    <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                       <td>{{ $item->created_at }}</td>
                       <td>{{ $item->name }}</td>
                       <td>{{ $item->remarks }}</td>
                      
                     </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th rowspan="1" colspan="1">Date</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">Remarks</th>
                  </tr>
                  </tfoot>
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
<!-- Modal for portfolio-->

@include('partials.position_portfolio_model')

<!-- Modal for adding positions -->
@include('partials.position_form_position_model')
      


<!-- Modal for editing portfolio -->
<div class="modal fade" id="editPortfolioModal" tabindex="-1" role="dialog" aria-labelledby="editPortfolioModalLabel" aria-hidden="true">
    <!-- Modal content goes here -->
</div>

<!-- Modal for editing position-->
<div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel" aria-hidden="true">

</div>




@endsection

@push('scripts')
<script>
function addFieldsPositionModel() 
{
  alert('ran addFieldsPositionModel');
  var segmentSelected = document.getElementById('segment').value;
  var scriptSelected = document.getElementById('script').value; //like nifty,bankNifty etc 
  var expirySelected = document.getElementById('expiry');
  // Clear existing options
  expirySelected.innerHTML = '';
}

function updateFieldsEdit() 
{
 alert('ran updateFieldsEdit');
  var segmentEdit = document.getElementById('segmentEdit').value;
  var scriptEdit = document.getElementById('scriptEdit').value;

  var scriptSelected = document.getElementById('script').value; //like nifty,bankNifty etc 

  var strickOptionDropdownEdit = document.getElementById('strikeOptionEdit');
        // Clear existing options
  strickOptionDropdownEdit.innerHTML = '';

    if (segmentEdit === 'Options') 
    {
        alert('ranjeet');

        //lets pull the selected script data 
       $.ajax({
            type: 'GET',
            url: '/ajaxExpiryDetails/'+scriptSelected,
            success: function(response) {
            $('#expiry').empty();
            $.each(data, function(id, text) {
                $('#expiry').append($('<option>').val(id).text(text));
                });               
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });

        
        document.getElementById('strikeDropdownEdit').style.display = 'block';
        document.getElementById('optionDropdownEdit').style.display = 'block';
    } 
    else 
    {
        document.getElementById('strikeDropdownEdit').style.display = 'none';
        document.getElementById('optionDropdownEdit').style.display = 'none';    
    }
}
    
  function savePortfolio() {
    $portfolioName = $("#portfolioName").val();
    $portfolioType = $("#portfolioType").val();
    $portfolioInterval = $("#portfolioInterval").val();

    var formData = $('#createPortfolioForm').serialize();
    $.ajax({
            type: 'POST',
            url: '/ajaxPortfolioSave',
            data: formData,
            success: function(response) {
               alert(response);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });

    $('#createPortfolioModal').modal('hide');
  }

  $(document).ready(function(){
    $('#createPortfolio').click(function(){
      $('#createPortfolioModal').modal('show');
    });

    
//Edit PortfolioButton clickEvent handle
    $('.edit-portfolio').click(function(event) {
      event.preventDefault();
      event.stopPropagation();
      var portfolioId = $(this).data('portfolio-id');
      $.ajax({
        type: 'GET',
        url: '/getPortfolioDetails/' + portfolioId,
        success: function(response) 
        {
        $('#editPortfolioModal').html(response);
        $('#editPortfolioModal').modal('show');
        },
        error: function(xhr, status, error) 
        {
        console.error(xhr.responseText);
        }
        });
    });

// Add Position button click event handler
    $('.add-position').click(function(event) 
    {
      event.preventDefault();
      event.stopPropagation();
      var pItemID = $(this).data('pitemid'); //position Item Id
      var scriptSelected = $(this).data('scriptName');//like nifty, bankNifty
      alert(pItemID);
      $('#addPositionModal').modal('show');

      document.getElementById('script').addEventListener('change', addFieldsPositionModel);
      document.getElementById('segment').addEventListener('change', addFieldsPositionModel);
       
    
      
    });



//EventFor editPosition button click
$('.edit-position').click(function(event) {
    
    event.preventDefault();
    event.stopPropagation();
    var positionId = $(this).data('position-id');
    //alert('ranjeet edit'+positionId);
    $.ajax({
        type: 'GET',
        url: '/get-position-details/' + positionId,
        success: function(response) {
           //alert('ranjeet edit'+response);
           $('#editPositionModal').html(response);
           $('#editPositionModal').modal('show');

           document.getElementById('segmentEdit').addEventListener('change', updateFieldsEdit);
          document.getElementById('scriptEdit').addEventListener('change', updateFieldsEdit);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});




    // Toggle Portfolio button click event handler
    $('.toggle-portfolio').click(function(event) 
    {
      event.preventDefault();
      event.stopPropagation();
      var $button = $(this);
      var portfolioId = $button.data('portfolio-id');
      var action = $button.data('action');
      $.ajax({
        type: 'POST',
        url: '/togglePortfolio',
        data: {
          portfolio_id: portfolioId,
          action: action,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          alert(action);
          var newAction = (action === 'activate') ? 'deactivate' : 'activate';
        $button.data('action', newAction);
        $button.text(newAction.charAt(0).toUpperCase() + newAction.slice(1));
        if (newAction === 'activate') 
        {
            $button.removeClass('btn-warning').addClass('btn-success');
        } 
        else 
        {
          $button.removeClass('btn-success').addClass('btn-warning');
        }
        },
        error: function(xhr, status, error) {
          // Handle error
          console.error(xhr.responseText);
        }
  });
});


updateFieldsEdit();



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
