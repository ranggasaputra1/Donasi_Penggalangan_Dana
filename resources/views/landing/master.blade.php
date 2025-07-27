<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Care</title>
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico" type="image/x-icon">
    @yield('style')
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/hover.css">
    <link rel="stylesheet" href="/css/landing.css">
</head>


<body style="font-family: poppins; background-color:#F7F7F7; height:100%" id="body">
    <section class="shadow-sm" id="searchbar">
        <nav class="navbar p-3 mobile" style="background-color:#435ebe;">
            <div class="container justify-content-between">
                <a href="/" class="navbar-brand" style="color: #ffffff;">
                    <img style="width: 35px; height: 100%" src="/assets/images/logo/logo.png" alt="Logo">
                </a>
                <form class="d-flex" role="search">
                    <div class="container-input">
                        <input type="text" placeholder="Pencarian" name="cari" class="input" aria-label="Search"
                            id="searchbox">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </div>
                </form>
            </div>
        </nav>


        <nav class="navbar dekstop" style="background-color:#435ebe;">
            <div class="container py-2 px-4">
                <a href="/" class="navbar-brand" style="color: #ffffff;">
                    <img style="width: 35px; height: 100%" src="/assets/images/logo/logo.png" alt="Logo">
                </a>
                @auth
                    @if (Auth::user()->role == 0)
                        <a href="/admin" class="nav-item px-2" style="color: #ffffff;text-decoration: none;">Dashboard</a>
                        <div class="dropdown">
                            <button style="color:#ffffff" class="btn dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/admin/profil"> Profil Saya</a>
                                </li>
                                <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="/logout">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/donasi-saya" class="nav-item px-2" style="color: #ffffff;text-decoration: none;">Donasi
                            Saya</a>
                        <a href="/campaign-saya" class="nav-item px-2"
                            style="color: #ffffff;text-decoration: none;">Campaign
                            Saya</a>
                        <div class="dropdown">
                            <button style="color:#ffffff" class="btn dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/profil"> Profil Saya</a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item" href="/verifikasi-akun/{{ Auth::user()->id }}">Verifikasi
                                        Akun</a>
                                </li>
                                <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="/logout">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <a href="/#campaign" class="nav-item px-2" style="color: #ffffff;text-decoration: none;">Campaign</a>
                    <a href="/blog" class="nav-item px-2" style="color: #ffffff;text-decoration: none;">Blog</a>
                    <a href="/login" class="nav-item px-2" style="color: #ffffff;text-decoration: none;">Login</a>
                @endauth
                <form class="ms-auto d-flex" role="search">
                    <div class="container-input">
                        <input type="text" placeholder="Pencarian" name="cari" class="input"
                            aria-label="Search" id="searchbox2">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </div>
                </form>
            </div>
        </nav>

    </section>

    <nav class="fixed-bottom mb-4 mobile">
        <div class="container-fluid" style="width: 100%;">
            <div class="container d-flex align-items-center justify-content-center shadow"
                style="background-image: linear-gradient(to bottom right, #364b98, #435ebe); height:75px; border-radius:750px; width: 100%; border: solid #ffffff 5px; margin: 0px; padding: 0px;">
                <div class="row">
                    <div class="col mx-1">
                        <a href="/"><img src="/assets/img/home-icon-pink.png" alt="" id="home"
                                style="height: 50px"></a>
                    </div>
                    <div class="col mx-1">
                        <a
                            @auth href="/donasi-saya" @else data-bs-toggle="modal" data-bs-target="#profile" @endauth><img
                                src="/assets/img/donation.png" alt="" style="height: 50px"></a>
                    </div>
                    <div class="col mx-1">
                        <a
                            @auth href="/campaign-saya" @else data-bs-toggle="modal" data-bs-target="#profile" @endauth><img
                                src="/assets/img/campaign.png" alt="" style="height: 50px"></a>
                    </div>
                    <div class="col mx-1">
                        <a data-bs-toggle="modal"
                            @auth data-bs-target="#profile" @else data-bs-target="#profile" @endauth><img
                                src="/assets/img/ava-icon-white.png" alt="" style="height: 50px"></a>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div id="category" class="d-none" style="background-color: rgb(255, 255, 255);">
        <div class="container text-center">
            <h5 class="p-4 mt-2" style="font-weight:bold; color: #435ebe;">Hasil Pencarian</h5>
            <button class="btn" id="back" style="border-radius: 50px; background-color:#435ebe"><a
                    style="color: #ffffff; text-decoration:none">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                        viewBox="0 0 1024 1024">
                        <path
                            d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"
                            fill="#ffffff"></path>
                    </svg>
                    <span>Kembali</span></a>
            </button>
            <div class="row justify-content-center p-4" id="hasil-search">
                <div id="result">
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @auth
                    @if (Auth::user()->role == 0)
                        <div class="modal-body">
                            <a class="dropdown-item" href="/admin/profil"> Profil Saya</a>
                            <hr class="dropdown-divider">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" href="/logout">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="modal-body">
                            <a class="dropdown-item" href="/profil"> Profil Saya</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="/verifikasi-akun/{{ Auth::user()->id }}">Verifikasi Akun</a>
                            <hr class="dropdown-divider">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" href="/logout">Logout</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="modal-head text-center p-3 border-bottom">
                        <h3 style="margin:0px">
                            Anda Perlu Login
                        </h3>
                    </div>
                    <div class="modal-body text-center">
                        <a class="btn" style="border-radius: 50px; background-color:#435ebe; color:#ffffff"
                            href="/login">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <div>
        @yield('content')
    </div>

    <footer class="py-3" style="background-color: rgb(255, 255, 255);">
        <p class="text-center text-muted mt-3">&copy; <?php echo date('Y'); ?> We Care</p>
    </footer>

    <script src="{{ asset('js/splide.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <script>
        const search = document.getElementById('searchbox');
        const search2 = document.getElementById('searchbox2');
        const searchResults = document.getElementById('hasil-search');
        const resultSpace = document.getElementById('result');
        const categoryspace = document.getElementById('category');
        const body = document.getElementById('body');
        const items = body.querySelectorAll('.item');
        const campaigns = body.querySelectorAll('.campaign');

        search.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            fetch('{{ route('cari') }}?filter=' + filter)
                .then(response => response.json())
                .then(data => {
                    let html = '';

                    if (data.length > 0) {
                        resultSpace.classList.add('d-none');
                        categoryspace.classList.remove("d-none");
                        campaigns.forEach(function(campaign) {
                            campaign.style.display = 'none';
                        });

                        items.forEach(function(item) {
                            item.style.display = 'none';
                        });

                        data.forEach(result => {
                            html += `
                            <a href="campaign/${result.slug_campaign}" class="item card hvr-grow m-2"
                    data-filter="${result.category_id}"
                    style="width: 18rem; padding: 0px;  border-color: #435ebe; text-decoration: none; color:black">
                    <img src="/storage/${result.foto_campaign}" class="card-img-top" alt="..."
                        style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>${result.judul_campaign}</h5>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"
                                style="background-color:#435ebe; width:${(result.dana_terkumpul/result.target_campaign)*100}%">
                            </div>
                        </div>
                        <p class="card-text mt-2">Donasi terkumpul : Rp${result.dana_terkumpul.toLocaleString()},00</p>
                        <p class="card-text">Aktif hingga : ${result.tgl_akhir_campaign}</p>
                    </div>
                </a>

                        `;
                        });
                    } else {
                        resultSpace.classList.remove('d-none');
                    }

                    searchResults.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        });


        search2.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            fetch('{{ route('cari') }}?filter=' + filter)
                .then(response => response.json())
                .then(data => {
                    let html = '';

                    if (data.length > 0) {
                        resultSpace.classList.add('d-none');
                        categoryspace.classList.remove("d-none");
                        campaigns.forEach(function(campaign) {
                            campaign.style.display = 'none';
                        });

                        items.forEach(function(item) {
                            item.style.display = 'none';
                        });

                        data.forEach(result => {
                            html += `
                            <a href="campaign/${result.slug_campaign}" class="item card hvr-grow m-2"
                    data-filter="${result.category_id}"
                    style="width: 18rem; padding: 0px;  border-color: #435ebe; text-decoration: none; color:black">
                    <img src="/storage/${result.foto_campaign}" class="card-img-top" alt="..."
                        style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>${result.judul_campaign}</h5>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"
                                style="background-color:#435ebe; width:${(result.dana_terkumpul/result.target_campaign)* 100}%">
                            </div>
                        </div>
                        <p class="card-text mt-2">Donasi terkumpul : Rp${result.dana_terkumpul.toLocaleString()},00</p>
                        <p class="card-text">Aktif hingga : ${result.tgl_akhir_campaign}</p>
                    </div>
                </a>

                        `;
                        });
                    } else {
                        resultSpace.classList.remove('d-none');
                    }

                    searchResults.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

    <script>
        const back = document.getElementById('back');
        // const back2 = document.getElementById('back2');
        back.addEventListener('click', function() {
            resultSpace.classList.remove('d-none');
            categoryspace.classList.add("d-none");
            campaigns.forEach(function(campaign) {
                campaign.style.display = 'block';
            });

            items.forEach(function(item) {
                item.style.display = 'block';
            });
        });

        // back2.addEventListener('click', function() {
        //     resultSpace.classList.remove('d-none');
        //     categoryspace.classList.add("d-none");
        //     campaigns.forEach(function(campaign) {
        //         campaign.style.display = 'block';
        //     });

        //     items.forEach(function(item) {
        //         item.style.display = 'block';
        //     });
        // });
    </script>


    @yield('script')
</body>

</html>
