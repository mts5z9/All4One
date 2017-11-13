<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add Scanner</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/add-scanner">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group<?php echo e($errors->has('serialNum') ? ' has-error' : ''); ?>">
                          <label for="serialNum" class="col-md-4 control-label">Serial Number</label>
                          <div class="col-md-6">
                              <input id="serialNum" type="text" class="form-control" name="serialNum" value="" required autofocus>
                              <?php if($errors->has('serialNum')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('serialNum')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('pin') ? ' has-error' : ''); ?>">
                          <label for="pin" class="col-md-4 control-label">PIN</label>
                          <div class="col-md-6">
                              <input id="pin" type="text" class="form-control" name="pin" value="" required autofocus>
                              <?php if($errors->has('pin')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('pin')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('model') ? ' has-error' : ''); ?>">
                          <label for="model" class="col-md-4 control-label">Scanner Model</label>
                          <div class="col-md-6">
                              <input id="model" type="text" class="form-control" name="model" value="" required autofocus>
                              <?php if($errors->has('model')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('model')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="locationID" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="locationID" id="locationID">
                              <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value = "<?php echo e($location->locationID); ?>"><?php echo e($location->address1); ?>, <?php echo e($location->city); ?>, <?php echo e($location->state); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Create
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