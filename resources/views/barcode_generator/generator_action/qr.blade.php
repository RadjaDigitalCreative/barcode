<a href="/print-qr/{{$data->id}}">{!! QrCode::size('40')->generate($data->qr_code) !!}</a>
