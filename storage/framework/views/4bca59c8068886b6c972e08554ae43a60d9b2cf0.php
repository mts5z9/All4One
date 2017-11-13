<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Reward History</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th>Reward</th>
                      <th>Description</th>
                      <th>Points Spent</th>
                      <th>Time</th>
                    </tr>
                    <tbody>
                      <?php $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($reward->businessName); ?></td>
                        <td><?php echo e($reward->title); ?></td>
                        <td><?php echo e($reward->descr); ?></td>
                        <td><?php echo e($reward->pointsSpent); ?></td>
                        <td><?php echo e($reward->claimTimeStamp); ?></td>
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