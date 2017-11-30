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
                      <th>Customer Email</th>
                      <th>Card ID</th>
                      <th>Time</th>
                      <th></th>
                    </tr>
                    <tbody>
                      @foreach ($scans as $scan)
                      <tr>
                        <td>{{$scan->patronEmail}}</td>
                        <td>{{$scan->cardID}}</td>
                        <td>{{$scan->timeStamp}}</td>
                        <td>
                          <a href="/removeScan/{{$scan->cardID}}/{{$scan->timeStamp}}" class="btn btn-info pull-left" style="margin-right: 3px;">Delete</a>
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
