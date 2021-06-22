@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Dashboard</b></h3>
        </div>
        <div class="panel-body">
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Total Company Listed</b></h3>
        </div>
        <div class="panel-body">
            <h4>{{$company}} Companies</h4>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Total Brand Owner Listed</b></h3>
        </div>
        <div class="panel-body">
            <h4>{{$brand}} Brands</h4>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Total Barcode & QR Created</b></h3>
        </div>
        <div class="panel-body">
            <h4>{{$barcode}} Barcode & QR Created</h4>
        </div>
    </div>

@endsection

@section('footer')
@endsection
