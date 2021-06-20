<a href="{{ route('print.barcode', $data->id) }}">{!! DNS1D::getBarcodeSVG($data->barcode_number, 'C39',1,50) !!} {!! QrCode::size('50')->generate($data->qr_code) !!}</a>
