<!-- resources/views/options/index.blade.php -->
@extends('layouts.app')
@section('title', 'Options')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-9">
        <!-- Filter Section -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <select class="form-control select2" id="index" name="index">
                <option value="NIFTY">Nifty</option>
                <option value="BANKNIFTY">Bank Nifty</option>
                <option value="FINNIFTY">Fin Nifty</option>
                <option value="MIDCPNIFTY">Midcap Nifty</option>
                </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <input type="date" class="form-control" id="expiry_day" name="expiry_day">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <label for="spot_price">Spot Price</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <label for="future_price">Future Price</label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                   <button type="button" class="btn btn-primary">Search</button> 
                </div>
            </div>
        </div>
        <!-- /.row -->
        </div>
         <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active">Options</li>
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
            <h3 class="card-title">Option Details</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th colspan="13">Call</th>
                        <th colspan="13">Put</th>
                    </tr>
                    <tr>
                    <th>OI Chng</th>
                    <th>OI</th>
                    <th>Volume</th>
                    <th>IV</th>
                    <th>LTP</th>
                    <th>Delta</th>
                    <th>Theta</th>
                    <th>Change</th>
                    <th>expiryDate</th>
                    <th>optionType</th>
                    <th>expiryTime</th>
                    <th>strikePrice</th>
                    <th>bidprice</th> 

                    <!--put area-->
                    <th>OI Chng</th>
                    <th>OI</th>
                    <th>Volume</th>
                    <th>IV</th>
                    <th>LTP</th>
                    <th>Delta</th>
                    <th>Theta</th>
                    <th>Change</th>
                    <th>expiryDate</th>
                    <th>optionType</th>
                    <th>expiryTime</th>
                    <th>strikePrice</th>
                    <th>bidprice</th> 

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $index => $item)

                    <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                      
                    <td>{{$item->changeinOpenInterest}}({{ $item->pchangeinOpenInterest}}%)</td>
                    <td>{{$item->openInterest}}</td>
                    <td>{{$item->totalTradedVolume}}</td>
                    <td>{{$item->impliedVolatility}}</td>
                    <td>{{$item->lastPrice}}</td>
                    <td>Delta</td>
                    <td>Theta</td>
                    <td>{{$item->change}} ({{$item->pChange}})%</td>


                    <td>{{ $item->expiryDate }}</td>
                    <td>{{ $item->optionType }}</td>
                    <td>{{ $item->expiryTime }}</td>
                    <td>{{ $item->strikePrice }}</td>
                    <td>{{ $item->bidprice }}</td>

                    <!-- put area -->
                    <td>{{$item->changeinOpenInterest}}({{ $item->pchangeinOpenInterest}}%)</td>
                    <td>{{$item->openInterest}}</td>
                    <td>{{$item->totalTradedVolume}}</td>
                    <td>{{$item->impliedVolatility}}</td>
                    <td>{{$item->lastPrice}}</td>
                    <td>Delta</td>
                    <td>Theta</td>
                    <td>{{$item->change}} ({{$item->pChange}})%</td>


                    <td>{{ $item->expiryDate }}</td>
                    <td>{{ $item->optionType }}</td>
                    <td>{{ $item->expiryTime }}</td>
                    <td>{{ $item->strikePrice }}</td>
                    <td>{{ $item->bidprice }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>OI Chng</th>
                    <th>OI</th>
                    <th>Volume</th>
                    <th>IV</th>
                    <th>LTP</th>
                    <th>Delta</th>
                    <th>Theta</th>
                    <th>Change</th>
                    <th>expiryDate</th>
                    <th>optionType</th>
                    <th>expiryTime</th>
                    <th>strikePrice</th>
                    <th>bidprice</th>

                    <!--put area-->
                    <th>OI Chng</th>
                    <th>OI</th>
                    <th>Volume</th>
                    <th>IV</th>
                    <th>LTP</th>
                    <th>Delta</th>
                    <th>Theta</th>
                    <th>Change</th>
                    <th>expiryDate</th>
                    <th>optionType</th>
                    <th>expiryTime</th>
                    <th>strikePrice</th>
                    <th>bidprice</th>

                  </tr>
                  <tr>
                    <th colspan="13">Call</th>
                    <th colspan="13">Put</th>
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
