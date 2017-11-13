<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Business Scanners</div>
                <div class="panel-body">
                  <?php if($status == 'actv'): ?><a href="/manageScanners/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Scanners</a>
                  <?php elseif($status == 'inactv'): ?><a href="/manageScanners/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Scanners</a><?php endif; ?>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Serial Number</th>
                      <th>pin</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      <?php $__currentLoopData = $scanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scanner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($scanner->serialNum); ?></td>
                        <td><?php echo e($scanner->pin); ?></td>
                        <td><?php echo e($scanner->locationID); ?></td>
                        <td><?php echo e($scanner->readerStatus); ?></td>
                        <td>
                          <a href="/editScanner/<?php echo e($scanner->serialNum); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          <?php if($scanner->readerStatus == 'actv'): ?><a href="/scannerStatus/<?php echo e($scanner->serialNum); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          <?php elseif($scanner->readerStatus == 'inactv'): ?><a href="/scannerStatus/<?php echo e($scanner->serialNum); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a><?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
          <a type="button" class="btn btn-info" name="Add" href="/addScanner">New Scanner</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>