@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Update Brand</h3>
        </div>
        <div class="panel-body">
            <div style="margin-bottom: 15px">
            </div>
            <form action="{{ route('brand.update', $data->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_bulan">Brand Name</label>
                        <input type="text" name="brand" value="{{$data->brand}}" class="form-control"
                               id="brand" placeholder="Brand">
                        @if ($errors->has('brand'))
                            <span class="help-block">{{ $errors->first('brand') }}</span>
                        @endif
                        <br>
                        <label for="jumlah_bulan">Number Handphone</label>
                        <input type="number" name="number" value="{{$data->number}}" class="form-control"
                               id="number" placeholder="Number Handphone">
                        @if ($errors->has('number'))
                            <span class="help-block">{{ $errors->first('number') }}</span>
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

