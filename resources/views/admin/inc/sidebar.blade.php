<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="">
        <i class="bi bi-box-seam"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.products.index') }}">
            <i class="bi bi-circle"></i><span>All</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.product-solds.index') }}">
            <i class="bi bi-circle"></i><span>Sold</span>
          </a>
        </li>
      </ul>
    </li><!-- End Product Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.categories.index') }}">
      <i class="bi bi-tags"></i>
        <span>Category</span>
      </a>
    </li><!-- End Category Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.orders.index') }}">
        <i class="bi bi-cart-fill"></i>
        <span>Order</span>
      </a>
    </li><!-- End Order Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.order-items.index') }}">
        <i class="bi bi-card-list"></i>
        <span>OrderItem</span>
      </a>
    </li><!-- End OrderItem Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.users.index') }}">
        <i class="bi bi-person"></i>
        <span>User</span>
      </a>
    </li><!-- End User Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.blogs.index') }}">
      <i class="bi bi-file-earmark-post"></i>
        <span>Blog</span>
      </a>
    </li><!-- End User Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
      </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li><!-- End Login Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li><!-- End Error 404 Page Nav -->

  </ul>

</aside><!-- End Sidebar-->