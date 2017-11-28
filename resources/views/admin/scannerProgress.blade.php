@extends('layouts.app')
{{ csrf_field() }}
<script type="text/javascript">

  window.onload = function()
  {
    var pBar = document.getElementById('progressBar');
    var scans = <?php echo json_encode($scans); ?>;
    var scanNumber = <?php echo count($scans); ?>;
    var div = document.getElementById('standby');
    var insert;
    for(i=0;i<scanNumber;i++)
    {
      (function(i)
      {
        setTimeout(function () {

          insert = scans[i];
          var width = (((i+1)/scanNumber)*100) + "%";
          pBar.style.width = width;
          pBar.innerHTML = width;
          if(insert == true){
            div.setAttribute("id","success");
          } else {
            div.setAttribute("id","failure");
          }
          insert = false;
          setTimeout(function () {
             div.setAttribute("id","standby");
          }, 500);
        }, 1500*i);

      })(i);
    }

  };
</script>
@section('content')
<?php $percentage = 0; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Scanner Results</div>

                <div id="scanner" class="panel-body center-block">
                  <div class="scannerlight" id='standby'></div>
                  <h3 id="scannertext">All4One Rewards Scanner</h3>
                  <div id="scannerarea" class="center-block"></div>
                </div>
                <div class="progress" style="margin:10px;">
                  <div id="progressBar" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="{{count($scans)}}" style="width:0%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-4">
          <a href="/scanner" class="btn btn-info pull-right" style="margin-right: 3px;display:inline;">Continue</a>
        </div>

    </div>


</div>


@endsection
