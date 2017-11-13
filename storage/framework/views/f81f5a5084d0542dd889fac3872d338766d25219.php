<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Rewards</div>
                <div class="panel-body">
                  <?php if($status == 'actv'): ?><a href="/manageRewards/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Rewards</a>
                  <?php elseif($status == 'inactv'): ?><a href="/manageRewards/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Rewards</a><?php endif; ?>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th style="width:20%">Active Dates</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      <?php $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($reward->title); ?></td>
                        <td><?php echo e($reward->descr); ?></td>
                        <td><?php echo e($reward->pointsNeeded); ?></td>
                        <td><?php echo e($reward->beginDate); ?> to <?php echo e($reward->endDate); ?></td>
                        <td>
                          <a href="/editReward/<?php echo e($reward->rewardID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          <?php if($reward->rewardStatus == 'actv'): ?><a href="/rewardStatus/<?php echo e($reward->rewardID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          <?php elseif($reward->rewardStatus == 'inactv'): ?><a href="/rewardStatus/<?php echo e($reward->rewardID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a><?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
          <a type="button" class="btn btn-info" name="Add" href="/createReward">New Reward</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>