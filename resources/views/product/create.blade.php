<div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('product.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">Category Name</label>
            <select name="category_id" class="form-control">
              <option>-- Choose your category --</option>
              @foreach($category as $c)
              <option value="{{$c->id}}">{{$c->category}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Product Name</label>
            <input type="text" name="product" value="{{ old('product') }}" class="form-control"
            id="product" placeholder="Product">
            @if ($errors->has('product'))
            <span class="help-block">{{ $errors->first('product') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Brand</label>
            <input type="text" name="brand" value="{{ old('brand') }}" class="form-control"
            id="brand" placeholder="Brand">
            @if ($errors->has('brand'))
            <span class="help-block">{{ $errors->first('brand') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Price</label>
            <input type="number" name="price" value="{{ old('price') }}" class="form-control"
            id="price" placeholder="Price">
            @if ($errors->has('price'))
            <span class="help-block">{{ $errors->first('price') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Time Created</label>
            <input type="date" name="time_act" value="{{ old('time_act') }}" class="form-control"
            id="time_act" placeholder="Time Created">
            @if ($errors->has('time_act'))
            <span class="help-block">{{ $errors->first('time_act') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Time Expired</label>
            <input type="date" name="time_exp" value="{{ old('time_exp') }}" class="form-control"
            id="time_exp" placeholder="Time Expired">
            @if ($errors->has('time_exp'))
            <span class="help-block">{{ $errors->first('time_exp') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Image </label>
            <input type="file" name="image" value="{{ old('image') }}" class="form-control"
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
</div>