@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Rewards</div>
                <div class="panel-body">
                  @if($status == 'actv')<a href="/manageRewards/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Rewards</a>
                  @elseif($status == 'inactv')<a href="/manageRewards/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Rewards</a>@endif
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      @foreach ($rewards as $reward)
                      <tr>
                        <td>{{$reward->title}}</td>
                        <td>{{$reward->descr}}</td>
                        <td>{{$reward->pointsNeeded}}</td>
                        <td>
                          <a href="/editReward/{{$reward->rewardID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          @if($reward->rewardStatus == 'actv')<a href="/rewardStatus/{{$reward->rewardID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          @elseif($reward->rewardStatus == 'inactv')<a href="/rewardStatus/{{$reward->rewardID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a>@endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
          <a type="button" class="btn btn-info" name="Add" href="/createReward">New Reward</a>
        </div>
    </div>
</div>
@endsection
