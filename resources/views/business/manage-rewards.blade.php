@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Rewards</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th style="width:20%">Active Dates</th>
                      <th style="width:20%">buttons</th>
                    </tr>
                    <tbody>
                      @foreach ($rewards as $reward)
                      <tr>
                        <td>{{$reward->title}}</td>
                        <td>{{$reward->descr}}</td>
                        <td>{{$reward->pointsNeeded}}</td>
                        <td>{{$reward->beginDate}} to {{$reward->endDate}}</td>
                        <td>
                          <button type="button" class="btn btn-info" name="redeem">Edit</button>
                          <button type="button" class="btn btn-info" name="redeem">Delete</button>
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
