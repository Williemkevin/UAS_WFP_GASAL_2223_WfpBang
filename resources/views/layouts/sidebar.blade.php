<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Fashion Brand</span>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="{{ (request()->is('/*') || request()->is('staff/dashboard*') || request()->is('owner/dashboard*')) ? 'menu-item active': 'menu-item'}}">
        <a href="{{ url('/') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Beranda</div>
        </a>
      </li>

      @auth
        @if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('staff'))
          <li class="{{ (request()->is('admin/category*')) ? 'menu-item active': 'menu-item'}}">
            <a href={{ route('admin.category.index') }} class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-ul"></i>
              <div data-i18n="Basic">Kategori</div>
            </a>
          </li>
        @endif
      @endauth

      @auth
        @if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('staff'))
        <li class="{{ (request()->is('admin/type*')) ? 'menu-item active': 'menu-item'}}">
          <a href={{ route('admin.type.index') }} class="menu-link">
            <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
            <div data-i18n="Boxicons">Tipe </div>
          </a>
        </li>
        @endif
      @endauth

      <li class="{{ (request()->is('product*')) ? 'menu-item active': 'menu-item'}}"class="menu-item">
        <a href="{{ url('product') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Tables">Produk</div>
        </a>
      </li>

      <li class="{{ (request()->is('transaksi*')) ? 'menu-item active': 'menu-item'}}">
        <a href="{{ url('transaksi') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-basket"></i>
          <div data-i18n="Tables">Transaksi</div>
        </a>
      </li>

      <li class="{{ (request()->is('buyer*')) ? 'menu-item active': 'menu-item'}}">
        <a href="{{ url('buyer') }} " class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Tables">Pembeli</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-coin-stack"></i>
          <div data-i18n="Tables">Poin</div>
        </a>
      </li>

      @auth

        <li class="{{ (request()->is('logout*')) ? 'menu-item active': 'menu-item'}}">
          <a  href="{{ route('logout') }}" class="menu-link"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="menu-icon tf-icons bx bx-log-out"></i>
              <div data-i18n="Analytics" style="color: red">Log Out</div>
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @else
        <li class="{{ (request()->is('login*')) ? 'menu-item active': 'menu-item'}}">
          <a href="{{ route('login') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-log-in"></i>
            <div data-i18n="Analytics" style="color: rgb(0, 160, 5)">Log In</div>
          </a>
        </li>
      @endauth



    </ul>
  </aside>
