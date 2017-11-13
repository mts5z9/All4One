<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Employees</div>
                <div class="panel-body">
                  <?php if($status == 'actv'): ?><a href="/manageEmployees/inactv" class="btn btn-info pull-left" style="margin-right: 3px;">Inactive Employees</a>
                  <?php elseif($status == 'inactv'): ?><a href="/manageEmployees/actv" class="btn btn-info pull-left" style="margin-right: 3px;">Active Employees</a><?php endif; ?>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th style="width: 30%"></th>
                    </tr>
                    <!--populate from database -->
                    <tbody>
                      <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($employee->firstName); ?> <?php echo e($employee->lastName); ?></td>
                        <td><?php echo e($employee->email); ?></td>
                        <?php if($employee->role == 'employee'): ?><td>Employee</td>
                        <?php elseif($employee->role == 'bAdmin'): ?><td>Business Admin</td>
                        <?php elseif($employee->role == 'Owner'): ?><td>Business Owner</td><?php endif; ?>
                        <td>
                          <?php if($employee->role != 'Owner'): ?>
                            <a href="/editEmployee/<?php echo e($employee->id); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            <?php if($employee->status == 'actv'): ?><a href="/employeeStatus/<?php echo e($employee->id); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Deactivate</a>
                            <?php elseif($employee->status == 'inactv'): ?><a href="/employeeStatus/<?php echo e($employee->id); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Reactivate</a><?php endif; ?>
                            <?php if($employee->role == 'employee' && Auth::user()->role == 'Owner'): ?><a href="/modifyRole/<?php echo e($employee->id); ?>/<?php echo e($employee->role); ?>" type="button" class="btn btn-info" name="type">Grant Admin</a>
                            <?php elseif($employee->role == 'bAdmin' && Auth::user()->role == 'Owner'): ?><a href="/modifyRole/<?php echo e($employee->id); ?>/<?php echo e($employee->role); ?>" type="button" class="btn btn-info" name="revoke">Revoke Admin</a><?php endif; ?>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col col-md-offset-11">
            <a type="button" class="btn btn-info" name="Add" href="/addEmployee">New Employee</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>