<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="../themes/minia/assets/images/logo.png" alt="" height="80" class="pt-3">
                    </span>

                    <span class="logo-sm">
                        <img src="../themes/minia/assets/images/logo.png" alt="" height="24">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../themes/minia/assets/images/logo.png" alt="" height="24">
                    </span>

                    <span class="logo-lg">
                        <img src="../themes/minia/assets/images/logo.png" alt="" height="80" class="pt-3">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm font-size-24 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <!-- Search Dropdown -->
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">
                            <button class="btn btn-primary" type="submit">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Language Dropdown -->
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="../themes/minia/assets/images/flags/russia.jpg" alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item notify-item language" data-lang="id">
                        <img src="../themes/minia/assets/images/flags/indonesia.png" alt="indonesia" class="me-1" height="12"> indonesia
                    </a>
                    <a href="#" class="dropdown-item notify-item language" data-lang="en">
                        <img src="../themes/minia/assets/images/flags/us.jpg" alt="English" class="me-1" height="12"> English
                    </a>
                    <a href="#" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="../themes/minia/assets/images/flags/russia.jpg" alt="Russian" class="me-1" height="12"> Russian
                    </a>
                </div>
            </div>

            <!-- Dark/Light Mode Toggle -->
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <!-- App Icons Grid -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="../themes/minia/assets/images/brands/github.png" alt="GitHub">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="../themes/minia/assets/images/brands/bitbucket.png" alt="Bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="../themes/minia/assets/images/brands/dribbble.png" alt="Dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill">1</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <div class="p-3">
                        <h6 class="m-0">Notifications</h6>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="#" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="../themes/minia/assets/images/users/teph.jpg" class="rounded-circle avatar-sm" alt="User">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Teppi</h6>
                                    <p class="mb-1">Pagii Sayanggg</p>
                                    <p class="font-size-13 text-muted mb-0"><i class="mdi mdi-clock-outline"></i> 5 min ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>

            <!-- User Profile -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="../themes/minia/assets/images/teppi.gif"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Revan F.H</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="../dashboard/index.php"><i class="mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Mendengarkan klik pada elemen dengan kelas .language
    document.querySelectorAll('.language').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            // Mendapatkan bahasa dan gambar terkait dari atribut data-lang
            var lang = item.getAttribute('data-lang');
            var imgSrc = '';

            // Tentukan gambar yang sesuai berdasarkan bahasa
            if (lang === 'id') {
                imgSrc = '../themes/minia/assets/images/flags/indonesia.png';
            } else if (lang === 'en') {
                imgSrc = '../themes/minia/assets/images/flags/us.jpg';
            } else if (lang === 'ru') {
                imgSrc = '../themes/minia/assets/images/flags/russia.jpg';
            }

            // Perbarui gambar di header
            document.getElementById('header-lang-img').src = imgSrc;
        });
    });
</script>
