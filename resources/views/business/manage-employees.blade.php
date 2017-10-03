@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Employees</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th style="width: 30%">buttons</th>
                    </tr>
                    <!--populate from database -->
                    <tbody>
                      @foreach ($employees as $employee)
                      <tr>
                        <td>{{$employee->firstName}}{{$employee->lastName}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->role}}</td>
                        <td>
                          @if($employee->role == 'employee' && Auth::user()->role == 'Owner')<button type="button" class="btn btn-info" name="type">Grant Admin</button>
                          @elseif($employee->role == 'bAdmin' && Auth::user()->role == 'Owner')<button type="button" class="btn btn-info" name="revoke">Revoke Admin</button>@endif
                          <a href="/user/{{ $employee->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          <button type="button" class="btn btn-info" name="remove">Remove</button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
            <button type="button" class="btn btn-info" name="Add">New Employee</button>
        </div>
    </div>
</div>
@endsection
