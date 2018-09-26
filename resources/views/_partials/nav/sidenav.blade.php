<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color: #e3f2fd;">
    <ul class="nav navbar-nav side-nav">
        <li class="{{ Request::is('dashboard/dashboard') ? "active" : "" }}">
            <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="{{ Request::is('dashboard/calendar') ? "active" : "" }}">
            <a href="{{route('calendar.index')}}"><i class="fa fa-calendar"></i> Calendar</a>
        </li>
        <li class="{{ Request::is('dashboard/jobs') ? "active" : "" }}">
            <a href="{{route('jobs.index')}}"><i class="fa fa-cogs"></i> Jobs</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-users"></i> Employees</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-stack-exchange"></i> Inventory</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-wrench"></i> Equipments</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-truck"></i> Vehicles</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> System Settings <i class="fa fa-fw fa-caret-down"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="dropdown-menu">
            <a href="{{route('users.index')}}" class="dropdown-item"><i class="fa fa-users"></i> Users</a>
            <a href="{{route('roles.index')}}" class="dropdown-item"><i class="fa fa-cog"></i> Roles</a>
            <a href="{{route('permissions.index')}}" class="dropdown-item"><i class="fa fa-pencil"></i> Permissions</a>
          </div>
      </li>

    </ul>
</div>
