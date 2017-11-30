@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Redeem Rewards</div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th style="width:30%">Progress</th>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th>Claim</th>
                      <th>User Points</th>
                    </tr>

                    <tbody>
                      @foreach ($rewards as $reward)
                      <tr>
                        <td>{{$reward->businessName}}</td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="{{$reward->points}}" aria-valuemin="0" aria-valuemax="{{$reward->pointsNeeded}}" style="width:{{($reward->points/$reward->pointsNeeded)*100}}%">
                              <span class="sr-only"></span>
                            </div>
                          </div>
                        </td>
                        <td>{{$reward->title}}</td>
                        <td>{{$reward->descr}}</td>
                        <td>{{$reward->pointsNeeded}} pts.</td>
                        @if($reward->points >= $reward->pointsNeeded)<td><a href="/claim/{{$reward->rewardID}}"class="btn btn-info">Claim</a></td>
                        @else<td><a href="/claim/{{$reward->rewardID}}"class="btn btn-info disabled">Claim</a></td>@endif
                        <td>{{$reward->points}} pts.</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
