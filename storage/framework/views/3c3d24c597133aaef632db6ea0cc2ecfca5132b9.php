<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Register Card</div>
                <h3>Note: If you register a new card your old card will no longer work.</h3>
                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/register-card">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group<?php echo e($errors->has('cardID') ? ' has-error' : ''); ?>">
                          <label for="title" class="col-md-4 control-label">Card ID</label>
                          <div class="col-md-6">
                              <input id="cardID" type="text" class="form-control" name="cardID" value="" required autofocus>
                              <?php if($errors->has('cardID')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('cardID')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Register New Card
                              </button>
                          </div>
                      </div>

                  </form>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>