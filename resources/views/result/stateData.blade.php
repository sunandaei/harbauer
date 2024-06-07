@extends('layouts.app')
@section('title', 'State Summary')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h2 style="display: inline-block;">State Summary</h2>
        </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('stateData') }}">Home</a></li>
               <li class="breadcrumb-item active">State Summary</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
    <!-- Info Boxes -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-info"><i class="fas fa-water"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Scheme</span>
                <span class="info-box-number">{{ $data['totalScheme'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Functional Scheme</span>
                <span class="info-box-number">{{ $data['functionalScheme'] }}%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-danger"><i class="fas fa-times-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Non Functional Scheme</span>
                <span class="info-box-number">{{ $data['nonFunctionalScheme'] }}%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Average Running Hours</span>
                <span class="info-box-number">{{ $data['avgRunningHours'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-primary"><i class="fas fa-bolt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Average Electric Hours</span>
                <span class="info-box-number">{{ $data['avgElectricHours'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-info"><i class="fas fa-tint"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">FHTC</span>
                <span class="info-box-number">{{ number_format($data['fhtc']) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-success"><i class="fas fa-home"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Households</span>
                <span class="info-box-number">{{ number_format($data['totalHouseholds']) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-warning"><i class="fas fa-percentage"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">% Coverage</span>
                <span class="info-box-number">{{ $data['coverage'] }}%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-info"><i class="fas fa-tint"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">LPCD</span>
                <span class="info-box-number">{{ $data['lpcd'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-primary"><i class="fas fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Wards</span>
                <span class="info-box-number">{{ number_format($data['totalWards']) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-success"><i class="fas fa-tint-slash"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Water Consumption</span>
                <span class="info-box-number">{{ $data['waterConsumption'] }}%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-danger"><i class="fas fa-tint"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Water Requirement</span>
                <span class="info-box-number">{{ number_format($data['waterRequirement'], 1) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 500px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script>
    function initMap() {
        var mapOptions = {
            center: { lat: 20.5937, lng: 78.9629 }, // Coordinates for India
            zoom: 5
        };
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

    google.maps.event.addDomListener(window, 'load', initMap);
</script>
@endpush

<style>
    .d-flex.justify-content-end.align-items-center {
        justify-content: flex-end;
    }
    .d-flex.justify-content-end.align-items-center .btn {
        margin-left: 5px;
    }
    .card-body {
        margin-bottom: 20px;
    }
</style>
