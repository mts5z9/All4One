<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Scans</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Card ID</th>
                      <th>Customer Name</th>
                      <th>Time</th>
                      <th></th>
                    </tr>
                    <tbody>
                      <?php $__currentLoopData = $scans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($scan->cardID); ?></td>
                        <td><?php echo e($scan->patronEmail); ?></td>
                        <td><?php echo e($scan->timeStamp); ?></td>
                        <td>
                          <a href="/editScanner/<?php echo e($scan->cardID); ?>/<?php echo e($scan->timeStamp); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                        </td>
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