<div class="modal fade" id="exampleModalCenter9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('user.payment.create')}}" method="post">
        @csrf

        <div class="modal-body">
          <div class="form-group">
            <label for="jumlah_bulan">User Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
            id="name" placeholder="Name">
            @if ($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
            id="email" placeholder="Email">
            @if ($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
            id="password" placeholder="Password">
            @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="jumlah_bulan">Phone Number</label>
            <input type="number" name="phone_number" value="{{ old('phone_number') }}" class="form-control"
            id="phone_number" placeholder="Phone Number">
            @if ($errors->has('phone_number'))
            <span class="help-block">{{ $errors->first('phone_number') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="company_id">Company Name</label>
            <select name="company_id" class="form-control">
              <option>-- Choose your company --</option>
              @foreach($company as $c)
              <option value="{{$c->id}}">{{$c->name_perusahaan}}</option>
              @endforeach
            </select>
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