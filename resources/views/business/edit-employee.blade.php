@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Employees</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/employee-edit/{{$employee->id}}">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                          <label for="firstName" class="col-md-4 control-label">First Name</label>
                          <div class="col-md-6">
                              <input id="firstName" type="text" class="form-control" name="firstName" value="{{$employee->firstName}}" required autofocus>
                              @if ($errors->has('firstName'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('firstName') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                          <label for="lastName" class="col-md-4 control-label">Last Name</label>
                          <div class="col-md-6">
                              <input id="lastName" type="text" class="form-control" name="lastName" value="{{$employee->lastName}}" required autofocus>
                              @if ($errors->has('lastName'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('lastName') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                          <label for="phone" class="col-md-4 control-label">Phone Number</label>
                          <div class="col-md-6">
                              <input id="phone" type="text" class="form-control" name="phone" value="{{$employee->phone}}" required autofocus>
                              @if ($errors->has('phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="location" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="location" id="location">
                              @foreach($locations as $location)
                                @if($employee->address1 == $location->address1))
                                  <option selected = "selected" value = "{{$location->locationID}}">{{$location->address1}}, {{$location->city}}, {{$location->state}}</option>
                                @else
                                  <option value = "{{$location->locationID}}">{{$location->address1}}, {{$location->city}}, {{$location->state}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{$employee->email}}" required>
                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
<!--
                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Password</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                          </div>
                      </div>
-->
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
