<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">
          Task Project
        </a>
      </div>
      <ul class="sidebar-menu">     
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="nav-link">
                <i class="fab fa-gg"></i><span>@lang('quickadmin.user-management.title')</span>
            </a>
        </li>           
    </ul>
    </aside>
  </div>
