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
                      <th>Active Dates</th>
                      <th>buttons</th>
                    </tr>
                    <!--populate from database -->
                    <tr>
                      <td>Free Drink</td>
                      <td>Redeem for 1 free drink at bar</td>
                      <td>8 pts.</td>
                      <td>9/18/2017 - 9/30/2017</td>
                      <td>
                        <button type="button" class="btn btn-info" name="redeem">Edit</button>
                        <button type="button" class="btn btn-info" name="redeem">Delete</button>
                      </td>
                    </tr>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
            <button type="button" class="btn btn-info" name="Add">New Reward</button>
        </div>
    </div>
</div>
@endsection
