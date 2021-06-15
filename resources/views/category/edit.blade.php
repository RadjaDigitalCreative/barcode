@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')

<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">Update Category</h3>
  </div>
  <div class="panel-body">
    <div style="margin-bottom: 15px">
    </div>
    <form action="{{ route('category.update', $data->id)}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">Category Name</label>
            <input type="text" name="category" value="{{$data->category}}" class="form-control"
            id="category" placeholder="Category">
            @if ($errors->has('category'))
            <span class="help-block">{{ $errors->first('category') }}</span>
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

