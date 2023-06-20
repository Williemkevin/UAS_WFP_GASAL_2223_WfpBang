<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Fashion Brand</span>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item active">
        <a href="{{ url('/') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Beranda</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-list-ul"></i>
          <div data-i18n="Basic">Kategori</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="icons-boxicons.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
          <div data-i18n="Boxicons">Tipe</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="{{ url('product') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Tables">Produk</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-basket"></i>
          <div data-i18n="Tables">Transaksi</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
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

      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-log-out"></i>
          <div data-i18n="Analytics" style="color: red">Log Out</div>
        </a>
      </li>
    </ul>
  </aside>
