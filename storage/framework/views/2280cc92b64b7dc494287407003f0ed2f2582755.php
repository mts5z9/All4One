<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Redeem Rewards</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th style="width:30%">Progress</th>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th>Claim</th>
                      <th>User Points</th>
                    </tr>

                    <tbody>
                      <?php $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($reward->businessName); ?></td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo e($reward->points); ?>" aria-valuemin="0" aria-valuemax="<?php echo e($reward->pointsNeeded); ?>" style="width:<?php echo e(($reward->points/$reward->pointsNeeded)*100); ?>%">
                              <span class="sr-only"></span>
                            </div>
                          </div>
                        </td>
                        <td><?php echo e($reward->title); ?></td>
                        <td><?php echo e($reward->descr); ?></td>
                        <td><?php echo e($reward->pointsNeeded); ?> pts.</td>
                        <?php if($reward->points >= $reward->pointsNeeded): ?><td><a href="/claim/<?php echo e($reward->rewardID); ?>"class="btn btn-info">Claim</a></td>
                        <?php else: ?><td><a href="/claim/<?php echo e($reward->rewardID); ?>"class="btn btn-info disabled">Claim</a></td><?php endif; ?>
                        <td><?php echo e($reward->points); ?> pts.</td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>