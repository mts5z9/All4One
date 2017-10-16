@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Location</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/edit-location/{{$location->locationID}}">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                          <label for="address1" class="col-md-4 control-label">Address Line 1</label>
                          <div class="col-md-6">
                              <input id="address1" type="text" class="form-control" name="address1" value="{{$location->address1}}" required autofocus>
                              @if ($errors->has('address1'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address1') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                          <label for="address2" class="col-md-4 control-label">Address Line 2</label>
                          <div class="col-md-6">
                              <input id="address2" type="text" class="form-control" name="address2" value="{{ $location->address2 }}" autofocus>
                              @if ($errors->has('address2'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address2') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                          <label for="city" class="col-md-4 control-label">City</label>
                          <div class="col-md-6">
                              <input id="city" type="text" class="form-control" name="city" value="{{ $location->city }}" required autofocus>
                              @if ($errors->has('city'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('city') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                          <label for="state" class="col-md-4 control-label">State</label>
                          <div class="col-md-6">
                              <input id="state" type="text" class="form-control" name="state" value="{{ $location->state }}" required autofocus>
                              @if ($errors->has('state'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('state') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('postalCode') ? ' has-error' : '' }}">
                          <label for="postalCode" class="col-md-4 control-label">Postal Code</label>
                          <div class="col-md-6">
                              <input id="postalCode" type="text" class="form-control" name="postalCode" value="{{ $location->postalCode }}" required autofocus>
                              @if ($errors->has('postalCode'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('postalCode') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{ $location->email }}" required>
                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                          <label for="phone" class="col-md-4 control-label">Phone</label>
                          <div class="col-md-6">
                              <input id="phone" type="text" class="form-control" name="phone" value="{{ $location->phone }}" required>
                              @if ($errors->has('phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Save
                              </button>
                          </div>
                      </div>

                  </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
