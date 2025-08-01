<nav class="navbar navbar-expand navbar-light navbar-top">
    <div class="container-fluid">
        <a href="#" class="burger-btn d-block">
            <i class="bi bi-justify fs-3"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-lg-0">
            </ul>
            {{-- Tambahkan @auth untuk menampilkan menu pengguna jika sudah login --}}
            @auth
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    @if (Auth()->user()->level == 0)
                                        Admin
                                    @endif
                                    @if (Auth()->user()->level == 1)
                                        Pegawai
                                    @endif
                                </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="/assets/images/faces/admin1.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Halo, {{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/admin/profil"><i class="icon-mid bi bi-person me-2"></i> Profil
                                Saya</a>
                        </li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" href="/logout"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Tampilkan tombol login jika pengguna belum login --}}
                <div class="d-flex">
                    <a href="/login" class="btn btn-primary">Login</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
