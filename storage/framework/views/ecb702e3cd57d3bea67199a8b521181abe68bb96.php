<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Employees</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/employee-edit/<?php echo e($employee->id); ?>">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group<?php echo e($errors->has('firstName') ? ' has-error' : ''); ?>">
                          <label for="firstName" class="col-md-4 control-label">First Name</label>
                          <div class="col-md-6">
                              <input id="firstName" type="text" class="form-control" name="firstName" value="<?php echo e($employee->firstName); ?>" required autofocus>
                              <?php if($errors->has('firstName')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('firstName')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('lastName') ? ' has-error' : ''); ?>">
                          <label for="lastName" class="col-md-4 control-label">Last Name</label>
                          <div class="col-md-6">
                              <input id="lastName" type="text" class="form-control" name="lastName" value="<?php echo e($employee->lastName); ?>" required autofocus>
                              <?php if($errors->has('lastName')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('lastName')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                          <label for="phone" class="col-md-4 control-label">Phone Number</label>
                          <div class="col-md-6">
                              <input id="phone" type="text" class="form-control" name="phone" value="<?php echo e($employee->phone); ?>" required autofocus>
                              <?php if($errors->has('phone')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('phone')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="location" class="col-md-4 control-label">Location</label>
                          <div class="col-md-6">
                            <select class="form-control" name="location" id="location">
                              <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($employee->address1 == $location->address1): ?>)
                                  <option selected = "selected" value = "<?php echo e($location->locationID); ?>"><?php echo e($location->address1); ?>, <?php echo e($location->city); ?>, <?php echo e($location->state); ?></option>
                                <?php else: ?>
                                  <option value = "<?php echo e($location->locationID); ?>"><?php echo e($location->address1); ?>, <?php echo e($location->city); ?>, <?php echo e($location->state); ?></option>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                      </div>

                      <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="<?php echo e($employee->email); ?>" required>
                              <?php if($errors->has('email')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('email')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
<!--
                      <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                          <label for="password" class="col-md-4 control-label">Password</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              <?php if($errors->has('password')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('password')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                          </div>
                      </div>
-->
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Save
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