@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/business-register">
                        {{ csrf_field() }}
                        <h3>Owner Information</h3>
                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>
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
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>
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
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address1" class="col-md-4 control-label">Address Line 1</label>
                            <div class="col-md-6">
                                <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" required autofocus>
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
                                <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}" autofocus>
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
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>
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
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autofocus>
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
                                <input id="postalCode" type="text" class="form-control" name="postalCode" value="{{ old('postalCode') }}" required autofocus>
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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
                        <h3>Business Information</h3>
                        <div class="form-group{{ $errors->has('businessName') ? ' has-error' : '' }}">
                            <label for="businessName" class="col-md-4 control-label">Business Name</label>
                            <div class="col-md-6">
                                <input id="businessName" type="text" class="form-control" name="businessName" value="{{ old('businessName') }}" required autofocus>
                                @if ($errors->has('businessName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Business Type</label>
                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('busDescr') ? ' has-error' : '' }}">
                            <label for="busDescr" class="col-md-4 control-label">Business Description</label>
                            <div class="col-md-6">
                                <input id="busDescr" type="text" class="form-control" name="busDescr" value="{{ old('busDescr') }}" required autofocus>
                                @if ($errors->has('busDescr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('busDescr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessPhone') ? ' has-error' : '' }}">
                            <label for="businessPhone" class="col-md-4 control-label">Business Phone Number</label>
                            <div class="col-md-6">
                                <input id="businessPhone" type="text" class="form-control" name="businessPhone" value="{{ old('businessPhone') }}" required autofocus>
                                @if ($errors->has('businessPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessAddress1') ? ' has-error' : '' }}">
                            <label for="businessAddress1" class="col-md-4 control-label">Address Line 1</label>
                            <div class="col-md-6">
                                <input id="businessAddress1" type="text" class="form-control" name="businessAddress1" value="{{ old('businessAddress1') }}" required autofocus>
                                @if ($errors->has('businessAddress1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessAddress1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessAddress2') ? ' has-error' : '' }}">
                            <label for="businessAddress2" class="col-md-4 control-label">Address Line 2</label>
                            <div class="col-md-6">
                                <input id="businessAddress2" type="text" class="form-control" name="businessAddress2" value="{{ old('businessAddress2') }}" autofocus>
                                @if ($errors->has('businessAddress2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessAddress2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessCity') ? ' has-error' : '' }}">
                            <label for="businessCity" class="col-md-4 control-label">City</label>
                            <div class="col-md-6">
                                <input id="businessCity" type="text" class="form-control" name="businessCity" value="{{ old('businessCity') }}" required autofocus>
                                @if ($errors->has('businessCity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessCity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessState') ? ' has-error' : '' }}">
                            <label for="businessState" class="col-md-4 control-label">State</label>
                            <div class="col-md-6">
                                <input id="businessState" type="text" class="form-control" name="businessState" value="{{ old('businessState') }}" required autofocus>
                                @if ($errors->has('businessState'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessState') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessPostalCode') ? ' has-error' : '' }}">
                            <label for="businessPostalCode" class="col-md-4 control-label">Postal Code</label>
                            <div class="col-md-6">
                                <input id="businessPostalCode" type="text" class="form-control" name="businessPostalCode" value="{{ old('businessPostalCode') }}" required autofocus>
                                @if ($errors->has('businessPostalCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessPostalCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessEmail') ? ' has-error' : '' }}">
                            <label for="businessEmail" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="businessEmail" type="email" class="form-control" name="businessEmail" value="{{ old('businessEmail') }}" required>
                                @if ($errors->has('businessEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
