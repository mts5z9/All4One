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
                    <!--populate from database -->
                    <tr>
                      <th>Rose Music Hall</th>
                      <th>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped active" role=" progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
                            <span class="sr-only">25% Complete</span>
                          </div>
                        </div>
                      </th>
                      <th>Free Drink</th>
                      <th>Redeem for 1 free drink at bar</th>
                      <th>8 pts.</th>
                      <th><button type="button" class="btn btn-info" name="redeem">Redeem</button></th>
                      <th>2 pts.</th>
                    </tr>
                    <tr>
                      <th>Sparky's Ice Cream</th>
                      <th>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped active" role=" progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                            <span class="sr-only">25% Complete</span>
                          </div>
                        </div>
                      </th>
                      <th>Free Scoop</th>
                      <th>Redeem for 1 free scoop of ice cream</th>
                      <th>10 pts.</th>
                      <th><button type="button" class="btn btn-info" name="redeem">Redeem</button></th>
                      <th>5 pts.</th>
                    </tr>
                    <tr>
                      <th>Trops</th>
                      <th>
                        <div class="progress">
                          <div class="progress-bar progress-bar-info progress-bar-striped active" role=" progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            <span class="sr-only">25% Complete</span>
                          </div>
                        </div>
                      </th>
                      <th>1 Dollar Drink</th>
                      <th>Get any drink for 1 dollar</th>
                      <th>6 pts.</th>
                      <th><button type="button" class="btn btn-info" name="redeem">Redeem</button></th>
                      <th>9 pts.</th>
                    </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>