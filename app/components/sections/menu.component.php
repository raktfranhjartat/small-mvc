<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container-fluid px-4">

    <!-- Logo -->
    <a class="navbar-brand logo fw-semibold d-flex align-items-center " href="/">
      <?= DOMAIN ?>
    </a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-3">
        <li class="nav-item">
          <a class="nav-link <?= isActive($pageTitle, 'Homepage') ?>" href="/">Homepage</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= isActive($pageTitle, 'About') ?>" href="/about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= isActive($pageTitle, 'Contact'); ?>" href="/contact">Contact</a>
        </li>


      </ul>
    </div>

  </div>
</nav>