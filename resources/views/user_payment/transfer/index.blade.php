@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
    <link rel="stylesheet" href="{{ asset('css/payment/payment-transfer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">

@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Update Transfer</h3>
            <form action="/user-payment/transfer/payment/{{ $user_data->id }}" method="post" id="form"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $user_data->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" email="" value="{{ $user_data->email }}"
                           disabled>
                </div>
                <div class="form-group">
                    <label for="date">Dari Tanggal</label>
                    <input type="text" class="form-control" id="date" value="{{ $date }}" disabled>
                </div>
                @foreach ($payment as $py)
                    <div class="btn btn-outline-primary btn-lg btn-payment-container"
                         style="margin-left: 10px; margin-top:10px ">
                        <input type="radio" name="paket" id="paket" value="{{ $py->id }}" class="btn-payment">
                        <br>
                        Paket {{ $py->month }} Kali Created
                        <br>
                        Rp. {{ number_format($py->price, 2, ',', '.') }}
                    </div>
                @endforeach
                @if ($errors->has('paket'))
                    <span class="help-block">{{ $errors->first('paket') }}</span>
                @endif
                <div style="margin-top: 10px" class="form-group">
                    <label for="date">Bukti Pembayaran</label>
                    <div class="box">
                        <input type="file" id="file-1" class="inputfile inputfile-1"
                               data-multiple-caption="{count} files selected" multiple style="display: none"
                               name="proof"/>
                        <label for="file-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                 viewBox="0 0 20 17">
                                <path
                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                            </svg>
                            <span>Choose a file&hellip;</span></label>
                    </div>
                    @if ($errors->has('proof'))
                        <span class="help-block">{{ $errors->first('proof') }}</span>
                    @endif
                </div>
                <a id="submit" class="btn btn-primary">Submit</a>
            </form>
        </div>
        <div class="panel-body">
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('js/custom-file-input.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('#reset').click(function () {
                    $('#paket').val(" ")
                    $('#file-1').val(" ")
                })
            })
            $("#submit").click(function () {
                $("#form").submit();
            });
        });
    </script>
@endsection
