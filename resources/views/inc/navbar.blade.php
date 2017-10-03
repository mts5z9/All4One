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
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'All4One') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
      &nbsp;
      @if (Auth::user())

      @endif
    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @elseif (Auth::user())

        <?php $userRole = Auth::user()->role;
        //patron links
          if($userRole == 'patron') {
            echo '<li><a href="/rewardHistory">Reward History</a></li>
                  <li><a href="/scanHistory">Scan History</a></li>
                  <li><a href="/redeem">Redeem Rewards</a></li>';
          }
        //business links
          if($userRole == 'employee'||$userRole == 'Owner'||$userRole == 'bAdmin') {
            echo '<li><a href="/manageScans">Manage Scans</a></li>';
              if($userRole == 'bAdmin' || $userRole == 'Owner'){
                echo '<li><a href="/manageRewards">Manage Rewards</a></li>
                      <li><a href="/manageEmployees">Manage Employees</a></li>';
              }
           }
        //admin links
          if($userRole == 'admin') {
                echo '<li><a href="/scanner">Scanner Simulation</a></li>';
          }
          ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    {{ Auth::user()->firstName }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <a href="/editAccount">Edit Account</a>
                      <?php if(Auth::user()->role == 'patron') { ?>
                        <a href="/registerCard">Register Card</a>
                      <?php } ?>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
                </ul>
            </li>
        <?php if(Auth::user()->role == 'Employee') { ?>
          <li><a href="/manageRewards">Manage Rewards</a></li>
          <li><a href="/statistics">Statistics</a></li>
          <li><a href="/manageEmployees">Manage Employees</a></li>
        <?php } ?>
        @endif
    </ul>
</div>
</div>
</nav>
