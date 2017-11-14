@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Business Account</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/edit-businessAccount">
                        {{ csrf_field() }}

                        <h3>Business Information</h3>
                        <div class="form-group{{ $errors->has('businessName') ? ' has-error' : '' }}">
                            <label for="businessName" class="col-md-4 control-label">Business Name</label>
                            <div class="col-md-6">
                                <input id="businessName" type="text" class="form-control" name="businessName" value="{{$business->businessName}}" required autofocus>
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
                                <input id="category" type="text" class="form-control" name="category" value="{{$business->category}}" required autofocus>
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
                                <input id="busDescr" type="text" class="form-control" name="busDescr" value="{{$business->busDescr}}" required autofocus>
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
                                <input id="businessPhone" type="text" class="form-control" name="businessPhone" value="{{$business->phone}}" required autofocus>
                                @if ($errors->has('businessPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('businessEmail') ? ' has-error' : '' }}">
                            <label for="businessEmail" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="businessEmail" type="email" class="form-control" name="businessEmail" value="{{$business->businessEmail}}" required>
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
