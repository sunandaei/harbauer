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
    <!-- Info Boxes 
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow-sm">
            <span class="info-box-icon bg-info"><i class="fas fa-water"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Scheme</span>
                <span class="info-box-number">{{ $data['totalScheme'] }}</span>
            </div>
        </div>
    </div>-->

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
                <span class="info-box-text">Average Electricity </span>
                <span class="info-box-number">Available  </span>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg8Fs15AVqgvQpljyPyLaWTrFXd9AbMIU"></script>
 <script>
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: { lat: 25.4183, lng: 86.1294 }, // Centered at Patna
        styles: [
          {
            featureType: 'administrative',
            elementType: 'geometry',
            stylers: [{ visibility: 'off' }]
          },
          {
            featureType: 'administrative.country',
            elementType: 'geometry',
            stylers: [{ visibility: 'on' }]
          },
          {
            featureType: 'administrative.province',
            elementType: 'geometry',
            stylers: [{ visibility: 'on' }]
          },
          {
            featureType: 'administrative.locality',
            elementType: 'geometry',
            stylers: [{ visibility: 'on' }]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{ visibility: 'off' }]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{ visibility: 'off' }]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{ visibility: 'simplified' }]
          },
          {
            featureType: 'landscape',
            elementType: 'geometry',
            stylers: [{ visibility: 'simplified' }]
          },
        ]
      });

      const biharCoords = [];

      const biharBoundary = new google.maps.Polygon({
        paths: biharCoords,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
      });

      biharBoundary.setMap(map);

      const markers = [
        { position: { lat: 25.2445, lng: 86.9710 }, title: "Bhagalpur" },
        { position: { lat: 25.5613, lng: 84.6897 }, title: "Bhojpur" },
        { position: { lat: 24.7914, lng: 85.0002 }, title: "Gaya" },
        { position: { lat: 25.1357, lng: 85.4438 }, title: "Nalanda" },
        { position: { lat: 24.8867, lng: 85.5360 }, title: "Nawada" },
        { position: { lat: 24.9481, lng: 84.0108 }, title: "Rohtas" }
      ];

      const icon = {
        url: "https://harbauer.sunandainternational.org/public/adminlte/dist/img/logoHar.jpeg", // URL to your custom icon
        scaledSize: new google.maps.Size(32, 32), // Scaled size of the icon
      };

      markers.forEach((markerData) => {
        new google.maps.Marker({
          position: markerData.position,
          map,
          title: markerData.title,
          icon: icon
        });
      });
    }

    google.maps.event.addDomListener(window, "load", initMap);
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
