@extends('layouts.app')
{{ csrf_field() }}
<script type="text/javascript">

  window.onload = function() {
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      url: '/newScan',
      dataType: "json",
      data: {
              'locationID' : <?php echo $data['locationID']; ?>,
              'cardID' : '<?php echo $data['cardID']; ?>'
            },
      success: function(response) { // What to do if we succeed
          console.log(response);
      }
    });
    var pBar = document.getElementById('progressBar');
    var scanNumber = <?php echo $data['scanNumber']; ?>;
    var div = document.getElementById('standby');
    var insert;
    for(i=0;i<scanNumber;i++)
    {
      (function(i)
      {
        setTimeout(function () {

          insert = true;
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
                <div class="panel-heading">Scanner Progress</div>

                <div id="scanner" class="panel-body center-block">
                  <div class="scannerlight" id='standby'></div>
                  <h3 id="scannertext">All4One Rewards Scanner</h3>
                  <div id="scannerarea" class="center-block"></div>
                </div>
                <div class="progress">
                  <div id="progressBar" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="{{$data['scanNumber']}}" style="width:0%"></div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
