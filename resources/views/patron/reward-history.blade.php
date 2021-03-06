@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Reward History</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Points Spent</th>
                      <th>Time</th>
                      <th>Reward Status</th>
                    </tr>
                    <tbody>
                      @foreach ($rewards as $reward)
                      <tr>
                        <td>{{$reward->businessName}}</td>
                        <td>{{$reward->title}}</td>
                        <td>{{$reward->descr}}</td>
                        <td>{{$reward->pointsSpent}}</td>
                        <td>{{$reward->claimTimeStamp}}</td>
                        <td>{{$reward->status}}</td>
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
