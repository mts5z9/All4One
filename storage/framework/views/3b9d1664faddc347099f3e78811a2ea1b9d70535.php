<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Create Location</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/location-create">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group<?php echo e($errors->has('address1') ? ' has-error' : ''); ?>">
                          <label for="address1" class="col-md-4 control-label">Address Line 1</label>
                          <div class="col-md-6">
                              <input id="address1" type="text" class="form-control" name="address1" value="<?php echo e(old('address1')); ?>" required autofocus>
                              <?php if($errors->has('address1')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('address1')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('address2') ? ' has-error' : ''); ?>">
                          <label for="address2" class="col-md-4 control-label">Address Line 2</label>
                          <div class="col-md-6">
                              <input id="address2" type="text" class="form-control" name="address2" value="<?php echo e(old('address2')); ?>" autofocus>
                              <?php if($errors->has('address2')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('address2')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('city') ? ' has-error' : ''); ?>">
                          <label for="city" class="col-md-4 control-label">City</label>
                          <div class="col-md-6">
                              <input id="city" type="text" class="form-control" name="city" value="<?php echo e(old('city')); ?>" required autofocus>
                              <?php if($errors->has('city')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('city')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('state') ? ' has-error' : ''); ?>">
                          <label for="state" class="col-md-4 control-label">State</label>
                          <div class="col-md-6">
                              <input id="state" type="text" class="form-control" name="state" value="<?php echo e(old('state')); ?>" required autofocus>
                              <?php if($errors->has('state')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('state')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('postalCode') ? ' has-error' : ''); ?>">
                          <label for="postalCode" class="col-md-4 control-label">Postal Code</label>
                          <div class="col-md-6">
                              <input id="postalCode" type="text" class="form-control" name="postalCode" value="<?php echo e(old('postalCode')); ?>" required autofocus>
                              <?php if($errors->has('postalCode')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('postalCode')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>

                      <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                              <?php if($errors->has('email')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('email')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                          <label for="phone" class="col-md-4 control-label">Phone</label>
                          <div class="col-md-6">
                              <input id="phone" type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required>
                              <?php if($errors->has('phone')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('phone')); ?></strong>
                                  </span>
                              <?php endif; ?>
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