@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Update Product</h3>
        </div>
        <div class="panel-body">
            <div style="margin-bottom: 15px">
            </div>
            <form action="{{ route('product.update', $data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_bulan">Category Name</label>
                        <select name="category_id" class="form-control">
                            <option value="{{$data->category_id}}">{{$data->category}}</option>
                            @foreach($category as $c)
                                <option value="{{$c->id}}">{{$c->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Brand Name</label>
                        <select name="brand_id" class="form-control">
                            <option value="{{$data->brand_id}}">{{$data->brand}}</option>
                            @foreach($brand as $c)
                                <option value="{{$c->id}}">{{$c->brand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Product Name</label>
                        <input type="text" name="product" value="{{$data->product}}" class="form-control"
                               id="product" placeholder="Product">
                        @if ($errors->has('product'))
                            <span class="help-block">{{ $errors->first('product') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">License</label>
                        <input type="number" name="license" value="{{$data->license}}" class="form-control"
                               id="license" placeholder="License">
                        @if ($errors->has('license'))
                            <span class="help-block">{{ $errors->first('license') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Price</label>
                        <input type="number" name="price" value="{{$data->price}}" class="form-control"
                               id="price" placeholder="Price">
                        @if ($errors->has('price'))
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Time Created</label>
                        <input type="date" name="time_act" value="{{$data->time_act}}" class="form-control"
                               id="time_act" placeholder="Time Created">
                        @if ($errors->has('time_act'))
                            <span class="help-block">{{ $errors->first('time_act') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Time Expired</label>
                        <input type="date" name="time_exp" value="{{$data->time_exp}}" class="form-control"
                               id="time_exp" placeholder="Time Expired">
                        @if ($errors->has('time_exp'))
                            <span class="help-block">{{ $errors->first('time_exp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bulan">Image </label>
                        <img width="10%" height="10%" src="{{ URL::to('/') }}/images/{{$data->image}}">
                        <input type="file" name="image" value="{{$data->image}}" class="form-control"
                               id="image" placeholder="Image Product">
                        @if ($errors->has('image'))
                            <span class="help-block">{{ $errors->first('image') }}</span>
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

