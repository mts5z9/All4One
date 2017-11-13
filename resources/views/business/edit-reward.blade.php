@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Reward</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/edit-reward/{{$reward->rewardID}}">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title" class="col-md-4 control-label">Title</label>
                          <div class="col-md-6">
                              <input id="title" type="text" class="form-control" name="title" value="{{$reward->title}}" required autofocus>
                              @if ($errors->has('title'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('descr') ? ' has-error' : '' }}">
                          <label for="descr" class="col-md-4 control-label">Description</label>
                          <div class="col-md-6">
                              <input id="descr" type="text" class="form-control" name="descr" value="{{$reward->descr}}" required autofocus>
                              @if ($errors->has('descr'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('descr') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('pointsNeeded') ? ' has-error' : '' }}">
                          <label for="pointsNeeded" class="col-md-4 control-label">Point Cost</label>
                          <div class="col-md-6">
                              <input id="pointsNeeded" type="text" class="form-control" name="pointsNeeded" value="{{$reward->pointsNeeded}}" required autofocus>
                              @if ($errors->has('pointsNeeded'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('pointsNeeded') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('beginDate') ? ' has-error' : '' }}">
                          <label for="beginDate" class="col-md-4 control-label">Start Date</label>
                          <div class="col-md-6">
                              <input type="text" name="beginDate" id="beginDate" alt="date" class="form-control IP_calendar" title="Y-m-d" value="{{$reward->beginDate}}" required autofocus>
                              @if ($errors->has('beginDate'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('beginDate') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                          <label for="endDate" class="col-md-4 control-label">End Date</label>
                          <div class="col-md-6">
                              <input type="text" name="endDate" id="endDate" alt="date" class="form-control IP_calendar" title="Y-m-d" value="{{$reward->endDate}}" required autofocus>
                              @if ($errors->has('endDate'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('endDate') }}</strong>
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
