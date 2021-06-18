<div class="modal fade" id="exampleModalCenter9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('brand.store')}}" method="post">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_bulan">Brand Name</label>
                        <input type="text" name="brand" value="{{ old('brand') }}" class="form-control"
                               id="brand" placeholder="Brand" required>
                        @if ($errors->has('brand'))
                            <span class="help-block">{{ $errors->first('brand') }}</span>
                        @endif
                        <br>
                        <label for="jumlah_bulan">Number Handphone</label>
                        <input type="number" name="number" value="{{ old('number') }}" class="form-control"
                               id="number" placeholder="Number Handphone" required>
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
</div>
