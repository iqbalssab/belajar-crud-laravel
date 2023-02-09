
<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-4" href="#">Benk Blog</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-light w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap mx-2">
        <form action="/logout" method="post">
          @csrf          
          <button type="submit" class="d-inline nav-link bg-primary me-2 border-0 text-light"><span class="text-light" data-feather="log-out"></span> Logout</button>
        </form>
      </div>
    </div>
  </header>