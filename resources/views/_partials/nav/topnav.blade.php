
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('dashboard.dashboard')}}"><img src="{{asset('images/logo.png')}}" class="img-fluid" alt="Responsive image"></a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">

    <!-- Tasks Notifications -->
    <li id="task_notification_bar" class="dropdown">
      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="fa fa-bars fa-2x animated bounceIn"></i>
        <span class="badge bg-important bg-tasks animated bounceIn">6</span>
      </a>
      <ul class="dropdown-menu extended tasks-bar">
        <!-- <div class="notify-arrow notify-arrow-blue"></div> -->
        <li>
          <p class="blue">Pending Jobs: 6</p>
        </li>
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Design PSD</div>
              <div class="percent"> 90%</div>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="90" aria-valuemin="0"
              aria-valuemax="100" style="width: 90%">
              <!-- <span class="sr-only">90% Complete (success)</span> -->
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Project One</div>
              <div class="percent"> 25%</div>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="25" aria-valuemin="0"
              aria-valuemax="100" style="width: 25%">
              <!-- <span class="sr-only">25% Complete (warning)</span> -->
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="#">See All Tasks</a>
        </li>
      </ul>
    </li><!-- Tasks Notifications end here -->

    <!-- Inbox Notifications -->
    <li class="dropdown">
      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="fa fa-envelope fa-2x animated flash"></i>
        <span class="badge bg-important bg-inbox animated flash">6</span>
      </a>
      <ul class="dropdown-menu extended inbox">
        <!-- <div class="notify-arrow notify-arrow-blue"></div> -->
        <li>
          <p class="blue">New Messages: 5</p>
        </li>

        <li>
          <a href="#">
            <span class="subject">
              <span class="from">Greg Martin</span>
              <span class="time pull-right">1 min</span>
            </span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="subject">
              <span class="from">Bob Hamar</span>
              <span class="time pull-right">15 mins</span>
            </span>
          </a>
        </li>

        <li>
          <a href="#">See All Tasks</a>
        </li>
      </ul>
    </li>

    <!-- Alert Notifications -->
    <li class="dropdown">
      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="fa fa-bell fa-2x animated shake"></i>
        <span class="badge bg-important bg-alert animated shake">6</span>
      </a>
      <ul class="dropdown-menu extended alert">
        <!-- <div class="notify-arrow notify-arrow-blue"></div> -->
        <li>
          <p class="blue">New Notifications: 6</p>
        </li>
        <li>
          <a href="#">Friend Request<span class="small italic pull-right">5 mins</span></a>
        </li>
        <li>
          <a href="#">Project 3 Completed<span class="small italic pull-right">15 mins</span></a>
        </li>
        <li>
          <a href="#">Nice Job Nick<span class="small italic pull-right">25 mins</span></a>
        </li>
        <li>
          <a href="#">See All Tasks</a>
        </li>
      </ul>
    </li>

      <!-- user login dropdown start-->
      @if (!Auth::guest())
      <!-- User Login Dropdown -->
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <span class="user-profile">
            <img src="{{asset('images/avatar.jpg')}}" class="img-fluid">
          </span>
          <span class="username">Hi, {{ Auth::user()->first_name }}</span>
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu extended logout">
          <li class="eborder-top">
            <a href="{{route('myprofile.index')}}"><i class="fa fa-user"></i> My Profile</a>
          </li>
          <li class="eborder-top">
            <a href="#"><i class="fa fa-percent"></i> My Progress</a>
          </li>
          <li class="eborder-top">
            <a href="#"><i class="fa fa-envelope"></i> Inbox</a>
          </li>
          <!-- <li class="eborder-top">
            <a href="#"><i class="fa fa-gear"></i> Settings</a>
          </li> -->
          <li class="eborder-top">
            <a href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i> Logout
          </a>
          @include('_partials.forms.logout')
          </li>
        </ul>
      </li>
      @endif
  </ul>
