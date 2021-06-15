@extends('layouts.master')
@section('title')Add User @endsection
@section('header')
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Add User</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" id="password" value="{{ old('password') }}" name="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lokasi</label>
                    <input type="text" disabled name="lokasi" value="{{ $company->name_perusahaan }}" class="form-control"
                        id="lokasi">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" id="jabatan" name="jabatan">
                        <option value="" disabled selected>-- Silahkan Pilih Jabatan --</option>
                        @foreach ($roles as $rl)
                            <option value="{{ $rl->id }}">{{ $rl->role_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('jabatan'))
                        <span class="help-block">{{ $errors->first('jabatan') }}</span>
                    @endif
                </div>
                <a class="btn btn-danger" id="reset">Reset</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#reset').click(function() {
                $('#name').val(" ")
                $('#email').val(" ")
                $('#password').val("")
                $('#jabatan').val(" ")
            })
        })
    </script>
@endsection
