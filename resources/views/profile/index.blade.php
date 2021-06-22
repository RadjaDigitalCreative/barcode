@extends('layouts.master')
@section('title')Edit Profile @endsection
@section('header')
@endsection
@section('style')
    <style>
        .ami {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Update Profile</h3>
        </div>
        <div class="panel-body">
            <div style="margin-bottom: 15px">
            </div>
            @if(auth()->user()->image == NULL)
                <img class="ami" src="{{ asset('images/60066108.png') }}" style="width:20%;" alt="">
            @else
                <img class="ami" src="{{ URL::to('/') }}/images/{{ auth()->user()->image }}" style="width:20%;" alt="">
            @endif
            <form action="{{ route('myprofile.update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_bulan">Username</label>
                        <input type="text" value="{{auth()->user()->name}}" name="name" class="form-control"
                               id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Email</label>
                        <input type="email" value="{{auth()->user()->email}}" name="email" class="form-control"
                               id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Old Password</label>
                        <input readonly type="password" value="{{auth()->user()->password}}" name="old_password"
                               class="form-control"
                               id="old_password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">New Password</label>
                        <input type="password" value="" name="password" class="form-control"
                               id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Lokasi Perusahaan</label>
                        <input type="text" name="lokasi" class="form-control"
                               id="lokasi" placeholder="Lokasi">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="number" value="{{auth()->user()->phone_number}}" name="phone_number" class="form-control"
                               id="phone_number" placeholder="Phone_number">
                    </div>
                    <div class="form-group">
                        <label for="image">Your Photo</label>
                        <input type="file" value="" name="image" class="form-control"
                               id="file" placeholder="Your Image">
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>


@endsection

