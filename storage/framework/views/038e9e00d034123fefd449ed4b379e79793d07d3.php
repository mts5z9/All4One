<script type="text/javascript">
  function changeColor(status){
    var div = document.getElementById('standby');
    div.setAttribute("id",status);
    setTimeout(function () {
       div.setAttribute("id","standby");
    }, 1000);
  }
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
    <?php
    //$date = new DateTime();
    //DB::table('SCAN')->insert(
    //  ['cardID' => '1234','timeStamp'=>$date,'locationID'=>'12345','businessID'=>'4231']
    //);
    ?>
  }
</script>
<?php $__env->startSection('content'); ?>
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
                <div class="panel-body center-block">
                  <form class="form-horizontal" method="POST" action="/scan">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                          <label for="locationID" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="locationID" id="locationID">
                              <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value = "<?php echo e($location->locationID); ?>"><?php echo e($location->businessName); ?>: <?php echo e($location->address1); ?>, <?php echo e($location->city); ?>, <?php echo e($location->state); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="cardID" class="col-md-4 control-label">Card</label>
                          <div class="col-md-6">
                            <select class="form-control" name="cardID" id="cardID">
                              <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value = "<?php echo e($card->cardID); ?>"><?php echo e($card->patronEmail); ?>, <?php echo e($card->cardID); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                <a href="#" onclick="changeColor('success')">Success Light</a>
                <a href="#" onclick="changeColor('failure')">Failure Light</a>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
  $( ".draggabble" ).on( "dragstop", function( event, ui ) {} );
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>