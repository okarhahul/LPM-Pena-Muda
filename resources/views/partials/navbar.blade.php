<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-2 ">
    <div class="container mt-1">
      <a class="navbar-brand" href="/">
        <img src="/asset/img/logo.png" alt="" width="40" class="d-inline-block align-text-top text"> LPM PENA MUDA
      </a>

      <ul class="navbar-nav">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @can('admin')
            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a></li>
            @endcan
            <li><a class="dropdown-item" href="/password.edit"><i class="bi bi-key"></i> Ubah Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Keluar <i class="bi bi-box-arrow-right"></i></button>
              </form>
            </li>
          </ul>
        </li>
      @else
        <li class="nav-item">
          <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
        </li>
      @endauth
      </ul>
    </div>
  </nav>