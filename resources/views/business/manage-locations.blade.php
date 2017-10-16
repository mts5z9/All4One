@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Business Locations</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Postal Code</th>
                      <th>Email</th>
                      <th>Phone #</th>
                      <th style="width:20%">buttons</th>
                    </tr>
                    <tbody>
                      @foreach ($locations as $location)
                      <tr>
                        <td>{{$location->locationID}}</td>
                        <td>{{$location->address1}}{{$location->address2}}</td>
                        <td>{{$location->city}}</td>
                        <td>{{$location->state}}</td>
                        <td>{{$location->postalCode}}</td>
                        <td>{{$location->email}}</td>
                        <td>{{$location->phone}}</td>
                        <td>
                          <a href="/editLocation/{{$location->locationID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
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
          <a type="button" class="btn btn-info" name="Add" href="/createLocation">New Location</a>
        </div>
    </div>
</div>
@endsection
