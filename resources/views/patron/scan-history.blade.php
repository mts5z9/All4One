@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Scan History</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th>Location</th>
                      <th>Time</th>
                    </tr>
                    <tbody>
                      @foreach ($scans as $scan)
                      <tr>
                        <td>{{$scan->businessName}}</td>
                        <td>{{$scan->city}}, {{$scan->state}}</td>
                        <td>{{$scan->timeStamp}}</td>
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
