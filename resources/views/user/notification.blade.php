@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
    @php
        $nomor = 1;
        function rupiah($m)
        {
          $rupiah = "Rp ".number_format($m,0,",",".").",-";
          return $rupiah;
        }
    @endphp
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Belum Bayar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
               aria-selected="false">Menunggu Konfirmasi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
               aria-selected="false">Sudah Terlunasi</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Belum Bayar</h3>
                </div>
                <div class="panel-body">
                    <div style="margin-bottom: 15px">
                    </div>
                    <table class="table table-striped" id="tableCategory" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                            <th>No. Telp</th>
                            <th>Total Pembayaran</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($belum_bayar as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->role_name}}</td>
                                <td>{{$row->lokasi}}</td>
                                <td>{{$row->phone_number}}</td>
                                <td>{{rupiah($row->total_payment)}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Menunggu Konfirmasi</h3>
                </div>
                <div class="panel-body">
                    <div style="margin-bottom: 15px">
                    </div>
                    <table class="table table-striped" id="tableCategory" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                            <th>No. Telp</th>
                            <th>Total Pembayaran</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($konfirmasi as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->role_name}}</td>
                                <td>{{$row->lokasi}}</td>
                                <td>{{$row->phone_number}}</td>
                                <td>{{rupiah($row->total_payment)}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Sudah Terlunasi</h3>
                </div>
                <div class="panel-body">
                    <div style="margin-bottom: 15px">
                    </div>
                    <table class="table table-striped" id="tableCategory" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                            <th>No. Telp</th>
                            <th>Total Pembayaran</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($terbayar as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->role_name}}</td>
                                <td>{{$row->lokasi}}</td>
                                <td>{{$row->phone_number}}</td>
                                <td>{{rupiah($row->total_payment)}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
            title: '{{session('success')}}',
            showConfirmButton: false,
            timer: 1500
        })
        @endif
    </script>
@endsection
