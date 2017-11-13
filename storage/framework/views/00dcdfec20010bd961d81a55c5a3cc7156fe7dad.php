<nav class="navbar navbar-default ">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'All4One')); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
      &nbsp;
      <?php if(Auth::user()): ?>

      <?php endif; ?>
    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        <?php if(Auth::guest()): ?>
            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
        <?php elseif(Auth::user()): ?>

        <?php $userRole = Auth::user()->role; ?>

        <!--patron links-->

        <?php if($userRole == 'patron'): ?>
          <li><a href="/rewardHistory">Reward History</a></li>
          <li><a href="/scanHistory">Scan History</a></li>
          <li><a href="/rewards">Redeem Rewards</a></li>
          <li><a href="/participatingBusinesses">Participating Businesses</a></li>
        <?php endif; ?>

        <!--business links-->
        <?php if($userRole == 'employee'): ?>
          <a href="/manageScans">Scans</a>
        <?php endif; ?>
        <?php if($userRole == 'Owner'||$userRole == 'bAdmin'): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              Manage <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
                <a href="/manageScans">Scans</a>
                <a href="/manageRewards/actv">Rewards</a>
                <a href="/manageEmployees/actv">Employees</a>
                <a href="/manageLocations/actv">Locations</a>
                <a href="/manageScanners/actv">Scanners</a>
            </li>
          </ul>
       </li>
       <?php endif; ?>
       <?php if($userRole == 'bAdmin' || $userRole == 'Owner'): ?>
        <li><a href="/scanStats/year">Scan Statistics</a></li>
        <li><a href="/rewardStats/year">Reward Statistics</a></li>
       <?php endif; ?>
       <!--Admin-->
        <?php if($userRole == 'admin'): ?>
          <li><a href="/scanner">Scanner Simulation</a></li>
        <?php endif; ?>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    <?php echo e(Auth::user()->firstName); ?> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                      <a href="<?php echo e(route('logout')); ?>"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <a href="/changePassword">Change Password</a>
                      <a href="/editAccount/<?php echo e(Auth::user()->id); ?>">Edit Account</a>
                            <?php if(Auth::user()->role == 'patron'): ?>
                              <a href="/registerCard">Register Card</a>
                            <?php elseif(Auth::user()->role == 'Owner'): ?>
                              <a href="/editBusinessAccount">Edit Business Information</a>
                            <?php endif; ?>
                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                          <?php echo e(csrf_field()); ?>

                      </form>
                  </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>
</div>
</nav>
