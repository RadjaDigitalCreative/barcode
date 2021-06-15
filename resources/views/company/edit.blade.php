@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')

<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">Update Company</h3>
  </div>
  <div class="panel-body">
    <div style="margin-bottom: 15px">
    </div>
    <form action="{{ route('company.update', $data->id)}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">Company Name</label>
            <input type="text" name="name_perusahaan" value="{{$data->name_perusahaan}}" class="form-control"
            id="name_perusahaan" placeholder="Category">
            @if ($errors->has('name_perusahaan'))
            <span class="help-block">{{ $errors->first('name_perusahaan') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Address</label>
            <input type="text" name="alamat" value="{{$data->alamat}}" class="form-control"
            id="alamat" placeholder="Address">
            @if ($errors->has('alamat'))
            <span class="help-block">{{ $errors->first('alamat') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Location</label>
            <input type="text" name="lokasi" value="{{$data->lokasi}}" class="form-control"
            id="lokasi" placeholder="Location">
            @if ($errors->has('lokasi'))
            <span class="help-block">{{ $errors->first('lokasi') }}</span>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  </div>
</div>


@endsection

