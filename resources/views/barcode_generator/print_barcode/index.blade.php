@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}">
@endsection
@section('content')
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
                                <label for="exampleInputEmail1">Jumlah Print</label>
                                <input type="number" class="form-control" id="printAmount" name="print_amount"
                                    value="{{ $bracode_data->print_amount }}" placeholder="Jumlah Print">
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel" style="wwidth: 21cm; min-height: 29.7cm;">
                <div class="panel-header">
                    <div style="padding: 5px">
                        <a href="{{ route('print.barcode.data', $bracode_data->id) }}" class="btn btn-primary btn-block"
                            target="_blank">print</a>
                    </div>
                </div>
                <div class="panel-body" id="printBarcode">
                    @if ($bracode_data->amount)
                        @for ($i = 0; $i < $bracode_data->amount; $i++)
                            <div class="col-md-3" id="barcode">
                                {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 1, 50) !!}
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
