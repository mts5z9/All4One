@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Scans</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Time</th>
                      <th>Customer Name</th>
                      <th>Card ID</th>
                      <th style="width:30%">buttons</th>
                    </tr>
                    <!--populate from database -->
                    <tr>
                      <td>8/24/17 3:45</td>
                      <td>John Smith</td>
                      <td>34256vhfd3424</td>
                      <td>
                        <button type="button" class="btn btn-info" name="redeem">Edit</button>
                        <button type="button" class="btn btn-info" name="redeem">Delete</button>
                      </td>
                    </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
