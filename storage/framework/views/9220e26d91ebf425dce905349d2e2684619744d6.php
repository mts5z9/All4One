<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Business Locations</div>
                <div class="panel-body">
                  <?php if($status == 'actv'): ?><a href="/manageLocations/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Locations</a>
                  <?php elseif($status == 'inactv'): ?><a href="/manageLocations/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Locations</a><?php endif; ?>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Postal Code</th>
                      <th>Email</th>
                      <th>Phone #</th>
                      <th style="width:20%"></th>
                    </tr>
                    <tbody>
                      <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($location->address1); ?><?php echo e($location->address2); ?></td>
                        <td><?php echo e($location->city); ?></td>
                        <td><?php echo e($location->state); ?></td>
                        <td><?php echo e($location->postalCode); ?></td>
                        <td><?php echo e($location->email); ?></td>
                        <td><?php echo e($location->phone); ?></td>
                        <td>
                          <a href="/editLocation/<?php echo e($location->locationID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                          <?php if($location->locationStatus == 'actv'): ?><a href="/locationStatus/<?php echo e($location->locationID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                          <?php elseif($location->locationStatus == 'inactv'): ?><a href="/locationStatus/<?php echo e($location->locationID); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a><?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
          <a type="button" class="btn btn-info" name="Add" href="/createLocation">New Location</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>