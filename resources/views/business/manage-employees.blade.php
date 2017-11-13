@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Employees</div>
                <div class="panel-body">
                  @if($status == 'actv')<a href="/manageEmployees/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Employees</a>
                  @elseif($status == 'inactv')<a href="/manageEmployees/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Employees</a>@endif
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th style="width: 30%"></th>
                    </tr>
                    <!--populate from database -->
                    <tbody>
                      @foreach ($employees as $employee)
                      <tr>
                        <td>{{$employee->firstName}} {{$employee->lastName}}</td>
                        <td>{{$employee->email}}</td>
                        @if($employee->role == 'employee')<td>Employee</td>
                        @elseif($employee->role == 'bAdmin')<td>Business Admin</td>
                        @elseif($employee->role == 'Owner')<td>Business Owner</td>@endif
                        <td>
                          @if($employee->role != 'Owner')
                            <a href="/editEmployee/{{$employee->id}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            @if($employee->status == 'actv')<a href="/employeeStatus/{{$employee->id}}" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                            @elseif($employee->status == 'inactv')<a href="/employeeStatus/{{$employee->id}}" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a>@endif
                            @if($employee->role == 'employee' && Auth::user()->role == 'Owner')<a href="/modifyRole/{{$employee->id}}/{{$employee->role}}" type="button" class="btn btn-info" name="type">Grant Admin</a>
                            @elseif($employee->role == 'bAdmin' && Auth::user()->role == 'Owner')<a href="/modifyRole/{{$employee->id}}/{{$employee->role}}" type="button" class="btn btn-info" name="revoke">Revoke Admin</a>@endif
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
            <a type="button" class="btn btn-info" name="Add" href="/addEmployee">New Employee</a>
        </div>
    </div>
</div>
@endsection
