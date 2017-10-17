@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add Scanner</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/add-scanner">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('serialNum') ? ' has-error' : '' }}">
                          <label for="serialNum" class="col-md-4 control-label">Serial Number</label>
                          <div class="col-md-6">
                              <input id="serialNum" type="text" class="form-control" name="serialNum" value="" required autofocus>
                              @if ($errors->has('serialNum'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('serialNum') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
                          <label for="pin" class="col-md-4 control-label">PIN</label>
                          <div class="col-md-6">
                              <input id="pin" type="text" class="form-control" name="pin" value="" required autofocus>
                              @if ($errors->has('pin'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('pin') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                          <label for="model" class="col-md-4 control-label">Scanner Model</label>
                          <div class="col-md-6">
                              <input id="model" type="text" class="form-control" name="model" value="" required autofocus>
                              @if ($errors->has('model'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('model') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="locationID" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="locationID" id="locationID">
                              @foreach($locations as $location)
                                  <option value = "{{$location->locationID}}">{{$location->address1}}, {{$location->city}}, {{$location->state}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Create
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
