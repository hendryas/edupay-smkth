<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
      <div class="sidebar-header">
          <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo" srcset="">
      </div>
      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                  <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                      <span>Dashboard</span>
                  </a>
              </li>
              {{-- Tambahkan menu lain di sini --}}
          </ul>
      </div>
      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>
