@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Register Card</div>
                <h3>Note: If you register a new card your old card will no longer work.</h3>
                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/register-card">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('cardID') ? ' has-error' : '' }}">
                          <label for="title" class="col-md-4 control-label">Card ID</label>
                          <div class="col-md-6">
                              <input id="cardID" type="text" class="form-control" name="cardID" value="" required autofocus>
                              @if ($errors->has('cardID'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('cardID') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Register New Card
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
