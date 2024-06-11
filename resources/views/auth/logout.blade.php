@extends('layouts.logout')
@section('title', 'logout')
@section('content-header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
             <img src="{{ asset('adminlte/dist/img/logo.jpg')}}" style="width: 150px;height: 131px;margin-left: 40%;  margin-top: 20px;    margin-bottom: 20px;">
            </div>

            <div class="card">
                <div class="card-header">{{ __('Logout') }}</div>

                <div class="card-body">
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="{{ route('logout') }}"
    onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
    Logout
</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
