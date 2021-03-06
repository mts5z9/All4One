@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Business Scanners</div>
                <div class="panel-body">
                  @if($status == 'actv')<a href="/manageScanners/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Scanners</a>
                  @elseif($status == 'inactv')<a href="/manageScanners/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Scanners</a>@endif
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Serial Number</th>
                      <th>pin</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      @foreach ($scanners as $scanner)
                      <tr>
                        <td>{{$scanner->serialNum}}</td>
                        <td>{{$scanner->pin}}</td>
                        <td>{{$scanner->locationID}}</td>
                        <td>{{$scanner->readerStatus}}</td>
                        <td>
                          <a href="/editScanner/{{$scanner->serialNum}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          @if($scanner->readerStatus == 'actv')<a href="/scannerStatus/{{$scanner->serialNum}}" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          @elseif($scanner->readerStatus == 'inactv')<a href="/scannerStatus/{{$scanner->serialNum}}" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a>@endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
          <a type="button" class="btn btn-info" name="Add" href="/addScanner">New Scanner</a>
        </div>
    </div>
</div>
@endsection
