@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Participating Businesses</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business Name</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Phone</th>
                    </tr>
                    <tbody>
                      @foreach ($businesses as $business)
                      <tr>
                        <td>{{$business->businessName}}</td>
                        <td>{{$business->category}}</td>
                        <td>{{$business->busDescr}}</td>
                        <td>{{$business->phone}}</td>
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
