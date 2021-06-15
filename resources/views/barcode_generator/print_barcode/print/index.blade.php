<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/barcode-print.css')}}">
    <title>Document</title>
</head>

<body>
    @if ($data->amount)
        @for ($i = 0; $i < $data->amount; $i++)
            {!! DNS1D::getBarcodeSVG($data->barcode_number, 'C39', 1, 50) !!}
        @endfor
    @else
        <div class="col-md-3" id="barcode">
            {!! DNS1D::getBarcodeSVG($data->barcode_number, 'C39', 1, 50) !!}
        </div>
    @endif
</body>
    <script>
        window.print();
        // document.location.href = "{{route('print.barcode.setting',$data->id)}}";
    </script>
</html>
