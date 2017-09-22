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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#draggable" ).draggable({
      snap: '.dragsnap',
      helper: cardHelper,
      stop: handleDragStop
    });
  } );

  function cardHelper( event ) {
    return '<div id="draggablehelper">All4One Rewards</div>';
  }

  function handleDragStop(event, ui) {
    changeColor('success');
  }
</script>
@section('content')
<div class="" id="draggable">All4One Rewards</div>
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

                <a href="#" onclick="changeColor('success')">Success Light</a>
                <a href="#" onclick="changeColor('failure')">Failure Light</a>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
  $( ".draggabble" ).on( "dragstop", function( event, ui ) {} );
</script>

@endsection
