<div class="modal fade" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('company.create')}}" method="post">
        @csrf

        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">Company Name</label>
            <input type="text" name="company" value="{{ old('company') }}" class="form-control"
            id="company" placeholder="Company">
            @if ($errors->has('company'))
            <span class="help-block">{{ $errors->first('company') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="form-control"
            id="location" placeholder="Location">
            @if ($errors->has('location'))
            <span class="help-block">{{ $errors->first('location') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Address</label>
            <input type="text" name="address" value="{{ old('address') }}" class="form-control"
            id="address" placeholder="Address">
            @if ($errors->has('address'))
            <span class="help-block">{{ $errors->first('address') }}</span>
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