@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}">
    <style>
        p{
            line-height: 60%;
        }
    </style>
@endsection
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Print Barcode</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
               aria-controls="profile" aria-selected="false">Print QR Code</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">QR Code Generator</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <div class="panel">
                            <div class="panel-body">
                                <form action="{{ route('print.qr.setting', $qr_data->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah Barcode</label>
                                        <input type="number" class="form-control" id="amount" name="amount_qr"
                                               value="{{ $qr_data->amount_qr }}" placeholder="Jumlah QR Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ukuran QR</label>
                                        <input type="number" class="form-control" id="printAmount" name="qr_wide"
                                               value="{{ $qr_data->qr_wide}}" placeholder="Ukuran QR">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="text-center">
                        {!! QrCode::size('150')->generate($qr_data->qr_code) !!}
                        <p><b>Item : </b> {{$qr_data->product}}</p>
                        <p><b>Owner Product : </b> {{$qr_data->brand}}</p>
                        <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                        <p><b>Expired Date : </b> {{$qr_data->time_exp}}</p>
                        <p><b>License Number : </b> {{$qr_data->license}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel" style="wwidth: 21cm; min-height: 29.7cm;">
                        <div class="panel-header">
                            <div style="padding: 5px">
                                <a href="{{ route('print.barcode.data', $qr_data->id) }}" class="btn btn-primary btn-block"
                                   target="_blank">print</a>
                            </div>
                        </div>
                        <div class="panel-body" id="printBarcode">
                            @if ($qr_data->amount_qr)
                                @for ($i = 0; $i < $qr_data->amount_qr; $i++)
                                    <div class="col-md-3" id="barcode" style="border-style: solid; text-align: center">
                                        {!! QrCode::size($qr_data->qr_wide)->generate($qr_data->qr_code) !!}
                                        <p><b>Item : </b> {{$qr_data->product}}</p>
                                        <p><b>Owner Product : </b> {{$qr_data->brand}}</p>
                                        <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                                        <p><b>Expired Date : </b> {{$qr_data->time_exp}}</p>
                                        <p><b>License Number : </b> {{$qr_data->license}}</p>
                                    </div>
                                @endfor
                            @else
                                <div class="col-md-3" id="barcode" style="border-style: solid; text-align: center">
                                    {!! QrCode::size('90')->generate($qr_data->qr_code) !!}
                                    <p><b>Item : </b> {{$qr_data->product}}</p>
                                    <p><b>Owner Product : </b> {{$qr_data->brand}}</p>
                                    <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                                    <p><b>Expired Date : </b> {{$qr_data->time_exp}}</p>
                                    <p><b>License Number : </b> {{$qr_data->license}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Barcode Generator</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <div class="panel">
                            <div class="panel-body">
                                <form action="{{ route('print.barcode.setting', $bracode_data->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah Barcode</label>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                               value="{{ $bracode_data->amount }}" placeholder="Jumlah Barcode">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ukuran Barcode</label>
                                        <input type="number" class="form-control" id="printAmount" name="barcode_wide"
                                               value="{{ $bracode_data->barcode_wide }}" placeholder="Wide">
                                        <input type="number" class="form-control" id="printAmount" name="barcode_height"
                                               value="{{ $bracode_data->barcode_height }}" placeholder="Height">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="text-center">
                        {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 3, 100) !!}
                        <p><b>Item : </b> {{$bracode_data->product}}</p>
                        <p><b>Owner Product : </b> {{$bracode_data->brand}}</p>
                        <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                        <p><b>Expired Date : </b> {{$bracode_data->time_exp}}</p>
                        <p><b>License Number : </b> {{$bracode_data->license}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel" style="wwidth: 21cm; min-height: 29.7cm;">
                        <div class="panel-header">
                            <div style="padding: 5px;>
                                <a href="{{ route('print.barcode.data', $bracode_data->id) }}"
                                   class="btn btn-primary btn-block"
                                   target="_blank">print</a>
                            </div>
                        </div>
                        <div class="panel-body" id="printBarcode">
                            @if ($bracode_data->amount)
                                @for ($i = 0; $i < $bracode_data->amount; $i++)
                                    <div style="border-style: solid; text-align: center" class="col-md-3" id="barcode">
                                        {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 1, $bracode_data->barcode_wide) !!}
                                        <p><b>Item : </b> {{$bracode_data->product}}</p>
                                        <p><b>Owner Product : </b> {{$bracode_data->brand}}</p>
                                        <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                                        <p><b>Expired Date : </b> {{$bracode_data->time_exp}}</p>
                                        <p><b>License Number : </b> {{$bracode_data->license}}</p>
                                    </div>
                                @endfor
                            @else
                                <div class="col-md-3" id="barcode">
                                    {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 1, 50) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')
    <script>
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        })
        @endif

    </script>
@endsection
