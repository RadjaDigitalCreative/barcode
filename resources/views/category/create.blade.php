<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('category.create')}}" method="post">
        @csrf

        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">Category Name</label>
            <input type="text" name="category" value="{{ old('category') }}" class="form-control"
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
</div>