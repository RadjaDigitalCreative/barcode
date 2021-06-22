<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style>
        p {
            line-height: 60%;
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

<body>
<page size="A4">
    <div class="panel-body text-center" id="printBarcode">
        @if ($qr_data->amount_qr)
            @for ($i = 0; $i < $qr_data->amount_qr; $i++)
                <div id="barcode" style="border-style: solid; display: inline-block; text-align: center">
                    {!! QrCode::size($qr_data->qr_wide)->generate($qr_data->qr_code) !!}
                    <p><b>Item : </b> {{$qr_data->product}}</p>
                    <p><b>Owner Product : </b> {{$qr_data->brand}}</p>
                    <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                    <p><b>Expired Date : </b> {{$qr_data->time_exp}}</p>
                    <p><b>License Number : </b> {{$qr_data->license}}</p>
                </div>
            @endfor
        @else
            <div id="barcode" style="border-style: solid; text-align: center">
                {!! QrCode::size('90')->generate($qr_data->qr_code) !!}
                <p><b>Item : </b> {{$qr_data->product}}</p>
                <p><b>Owner Product : </b> {{$qr_data->brand}}</p>
                <p><b>Produced By : </b> {{auth()->user()->name}}</p>
                <p><b>Expired Date : </b> {{$qr_data->time_exp}}</p>
                <p><b>License Number : </b> {{$qr_data->license}}</p>
            </div>
        @endif
    </div>
</page>
</body>


</html>
