@extends('layouts.app')
<script type="text/javascript">
  function changeColor(status){
    var div = document.getElementById('standby');
    div.setAttribute("id",status);
    setTimeout(function () {
       div.setAttribute("id","standby");
    }, 1000);
  }
</script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Scanner Simulation</div>
                <div id="scanner" class="panel-body center-block">
                  <div class="scannerlight" id='standby'></div>
                  <h3 id="scannertext">All4One Rewards Scanner</h3>
                  <div id="scannerarea" class="center-block">
                    <div class="dragsnap">  </div>
                  </div>
                </div>
                <div class="panel-body center-block">
                  <form class="form-horizontal" method="POST" action="/newScan">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label for="locationID" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="locationID" id="locationID">
                              @foreach($locations as $location)
                                  <option value = "{{$location->locationID}}">{{$location->businessName}}: {{$location->address1}}, {{$location->city}}, {{$location->state}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="cardID" class="col-md-4 control-label">Card</label>
                          <div class="col-md-6">
                            <select class="form-control" name="cardID" id="cardID">
                              @foreach($cards as $card)
                                  <option value = "{{$card->cardID}}">{{$card->patronEmail}}, {{$card->cardID}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="cardID" class="col-md-4 control-label">Number of Scans</label>
                        <div class="col-md-6">
                          <select class="form-control" name="scanNumber" id="scanNumber">
                                <option value = "1">1</option>
                                <option value = "5">5</option>
                                <option value = "10">10</option>
                                <option value = "20">20</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  New Scan
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
