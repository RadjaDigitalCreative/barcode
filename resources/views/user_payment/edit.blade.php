@extends('layouts.master')
@section('title')Edit User @endsection
@section('header')
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Update User</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('user-payment.update', $user->id) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" class="form-control" id="userName" name="user_name" placeholder="User Name"
                        value="{{ $user->name }}">
                    @if ($errors->has('user_name'))
                        <span class="help-block">{{ $errors->first('user_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Alamat emial"
                        value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" value="{{ $user->password }}" disabled>
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control" id="Lokasi" value="{{ $user->lokasi }}" disabled>
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
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script>

    </script>
@endsection
