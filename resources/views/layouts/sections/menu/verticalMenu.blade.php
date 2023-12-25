<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
          <img src="/assets/img/legal/small-logo.png" alt="" style="width: 40px;" /> 
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item active">
      <a href="/admin" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/analytics" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bar-chart-square"></i>
        <div data-i18n="Analytics">Analytics</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/agreements" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-report"></i>
        <div data-i18n="Agreements">Agreements</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/categories" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Agreements">Categories</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/promotions" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Agreements">Promotions</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/blogs" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Blog">Blog</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/blog-categories" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Blog">Blog Categories</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/testimonials" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Testimonials">Testimonials</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/customers" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Customers">Customers</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/transactions" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dollar"></i>
        <div data-i18n="Transactions">Transactions</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/admin/settings" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div data-i18n="Settings">Settings</div>
      </a>
    </li>
  </ul>
  
  <div class="user-siderbar-action py-3">
      <div class="d-flex align-items-center justify-content-between">
          <div class="avatars">
              <img src="{{ asset('assets/img/avatars/1.png') }}" alt="" />
          </div>
          <div class="avatar-name">
              <h4>Admin</h4>
          </div>
          <div class="logout-action">
              <a  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                     <i class="bx bx-log-out"></i>
             </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
          </div>
      </div>
  </div>

</aside>
