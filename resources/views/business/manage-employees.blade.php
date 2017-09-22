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
                    <tr>
                      <td>John Smith</td>
                      <td>employee1@gmail.com</td>
                      <td>Employee</td>
                      <td>
                        <button type="button" class="btn btn-info" name="redeem">Edit</button>
                        <button type="button" class="btn btn-info" name="type">Promote Admin</button>
                        <button type="button" class="btn btn-info" name="redeem">Remove</button>
                      </td>
                    </tr>
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
