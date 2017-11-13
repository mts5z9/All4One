<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Create Reward</div>

                <div class="panel-body table-responsive">
                  <form class="form-horizontal" method="POST" action="/reward-create">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                          <label for="title" class="col-md-4 control-label">Title</label>
                          <div class="col-md-6">
                              <input id="title" type="text" class="form-control" name="title" value="" required autofocus>
                              <?php if($errors->has('title')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('title')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('descr') ? ' has-error' : ''); ?>">
                          <label for="descr" class="col-md-4 control-label">Description</label>
                          <div class="col-md-6">
                              <input id="descr" type="text" class="form-control" name="descr" value="" required autofocus>
                              <?php if($errors->has('descr')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('descr')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('pointsNeeded') ? ' has-error' : ''); ?>">
                          <label for="pointsNeeded" class="col-md-4 control-label">Point Cost</label>
                          <div class="col-md-6">
                              <input id="pointsNeeded" type="text" class="form-control" name="pointsNeeded" value="" required autofocus>
                              <?php if($errors->has('pointsNeeded')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('pointsNeeded')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>

                      <div class="form-group<?php echo e($errors->has('beginDate') ? ' has-error' : ''); ?>">
                          <label for="beginDate" class="col-md-4 control-label">Start Date</label>
                          <div class="col-md-6">
                              <input type="text" name="beginDate" id="beginDate" alt="date" class="form-control IP_calendar" title="Y-m-d" value="" required autofocus>
                              <?php if($errors->has('beginDate')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('beginDate')); ?></strong>
                                  </span>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('endDate') ? ' has-error' : ''); ?>">
                          <label for="endDate" class="col-md-4 control-label">End Date</label>
                          <div class="col-md-6">
                              <input type="text" name="endDate" id="endDate" alt="date" class="form-control IP_calendar" title="Y-m-d" value="" required autofocus>
                              <?php if($errors->has('endDate')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('endDate')); ?></strong>
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