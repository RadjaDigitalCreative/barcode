<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('klorofil/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('klorofil/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('klorofil/vendor/linearicons/style.css') }}">
{{-- <link rel="stylesheet" href="{{asset('')}}assets/vendor/chartist/css/chartist-custom.css"> --}}
<!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('klorofil/css/main.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('klorofil/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('klorofil/img/favicon.png') }}">
    {{-- DATA TABLE --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/barcode-print.css')}}">
    <title>Document</title>
    <style>
        p {
            line-height: 60%;
            font-size:10px;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            padding: 10;
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }

        .line {
            margin-bottom: 0.5cm;

        }
    </style>
</head>

<body onload="window.print()">
<page size="A4">
    <div class="panel-body text-center" id="printBarcode">
        @if ($bracode_data->amount)
            @for ($i = 0; $i < $bracode_data->amount; $i++)
                <div id="barcode" style="border-style: solid; display: inline-block; text-align: center">
                    {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 1, $bracode_data->barcode_height) !!}
                    <p><b>Item : </b> {{$bracode_data->product}}</p>
                    <p><b>Owner Product : </b> {{$bracode_data->brand}}</p>
                    <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                    <p><b>Expired Date : </b> {{$bracode_data->time_exp}}</p>
                    <p><b>License Number : </b> {{$bracode_data->license}}</p>
                </div>
            @endfor
        @else
            <div id="barcode" style="border-style: solid; text-align: center">
                {!! DNS1D::getBarcodeSVG($bracode_data->barcode_number, 'C39', 1, 100) !!}
                <p><b>Item : </b> {{$bracode_data->product}}</p>
                <p><b>Owner Product : </b> {{$bracode_data->brand}}</p>
                <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                <p><b>Expired Date : </b> {{$bracode_data->time_exp}}</p>
                <p><b>License Number : </b> {{$bracode_data->license}}</p>
            </div>
        @endif
    </div>
</page>
</body>
<script src="{{ asset('klorofil/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('klorofil/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('klorofil/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('klorofil/scripts/klorofil-common.js') }}"></script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

</html>
