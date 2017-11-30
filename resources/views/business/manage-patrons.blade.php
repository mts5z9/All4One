@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Manage Patrons
                  <form class="form-horizontal" action="/searchManagePatrons" method="post">
                    {{ csrf_field() }}
                    <div class="panel-body">
                      <div class="input-group">
                        <input id="search" name='search' type="text" class="form-control" placeholder="Search by customer email...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Search</button>
                        </span>
                      </div><!-- /input-group -->
                    </div>
                  </form>

                </div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Point Total</th>
                      <th style="width: 30%"></th>
                    </tr>
                    <tbody>
                      @foreach ($patrons as $patron)
                      <tr>
                        <td>{{$patron->email}}</td>
                        <td>{{$patron->firstName}} {{$patron->lastName}}</td>
                        <td>{{$patron->total}}</td>
                        <td>
                          <a href="/customerRewards/{{$patron->email}}" class="btn btn-info" style="margin-right: 3px;">Available Rewards</a>
                          <a href="/addScan/{{$patron->email}}" class="btn btn-info" style="margin-right: 3px;">Add Scan</a>
                        </td>
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
