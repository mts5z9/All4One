@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Business Locations</div>
                <div class="panel-body">
                  @if($status == 'actv')<a href="/manageLocations/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Locations</a>
                  @elseif($status == 'inactv')<a href="/manageLocations/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Locations</a>@endif
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Postal Code</th>
                      <th>Email</th>
                      <th>Phone #</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      @foreach ($locations as $location)
                      <tr>
                        <td>{{$location->address1}}{{$location->address2}}</td>
                        <td>{{$location->city}}</td>
                        <td>{{$location->state}}</td>
                        <td>{{$location->postalCode}}</td>
                        <td>{{$location->email}}</td>
                        <td>{{$location->phone}}</td>
                        <td>
                          <a href="/editLocation/{{$location->locationID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          @if($location->locationStatus == 'actv')<a href="/locationStatus/{{$location->locationID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          @elseif($location->locationStatus == 'inactv')<a href="/locationStatus/{{$location->locationID}}" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a>@endif
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
