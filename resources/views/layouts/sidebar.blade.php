<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="/"><img style="width: 100px; height: 100%" src="/assets/images/logo/wecare.png"
                        alt="Logo"></a>
            </div>
            <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                <!-- Theme Toggle Icons -->
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}">
                <a href="/admin" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/penggalang-dana*') ? 'active' : '' }}">
                <a href="/admin/penggalang-dana/kuisioner" class="sidebar-link">
                    <i class="bi bi-person-hearts"></i>
                    <span>Penggalang Dana</span>
                </a>
            </li>
            <li class="sidebar-item has-sub {{ request()->is('admin/campaign*') || request()->is('admin/artikel-blog') ? 'active' : '' }}"
                id="programKebaikan">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-heart-fill"></i>
                    <span>Program Kebaikan</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item {{ request()->is('admin/campaign/campaign') ? 'active' : '' }}">
                        <a href="/admin/campaign/campaign">Postingan Donasi</a>
                    </li>
                    <li class="submenu-item {{ request()->is('admin/campaign/berita') ? 'active' : '' }}">
                        <a href="/admin/campaign/berita">Berita</a>
                    </li>
                    <li class="submenu-item {{ request()->is('admin/campaign/kategori') ? 'active' : '' }}">
                        <a href="/admin/campaign/kategori">Kategori</a>
                    </li>
                    <li class="submenu-item {{ request()->is('admin/artikel-blog') ? 'active' : '' }}">
                        <a href="/admin/artikel-blog">Halaman Artikel</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('admin/transaksi-donasi') ? 'active' : '' }}">
                <a href="/admin/transaksi-donasi" class='sidebar-link'>
                    <i class="bi bi-wallet-fill"></i>
                    <span>Transaksi Donasi</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('#') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat Donasi</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/donatur') ? 'active' : '' }}">
                <a href="/admin/donatur" class='sidebar-link'>
                    <i class="bi bi-person-heart"></i>
                    <span>Donatur</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- CSS untuk memastikan submenu terbuka saat dropdown dipilih -->
<style>
    /* CSS untuk memastikan submenu terbuka */
    .sidebar-item.open .submenu {
        display: block;
        /* Tampilkan submenu */
    }

    /* Secara default sembunyikan submenu */
    .submenu {
        display: none;
    }
</style>

<!-- JavaScript untuk menjaga dropdown tetap terbuka -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua menu yang memiliki sub-menu
        const submenuItems = document.querySelectorAll('.sidebar-item.has-sub');

        submenuItems.forEach(function(item) {
            const link = item.querySelector('.sidebar-link');

            // Cek apakah submenu-item saat ini sedang aktif
            if (item.classList.contains('active')) {
                item.classList.add('open'); // Tambahkan class 'open' jika aktif
            }

            // Tambahkan event listener ke link dropdown
            link.addEventListener('click', function(e) {
                // Jika submenu sudah terbuka, biarkan tetap terbuka
                if (item.classList.contains('open')) {
                    item.classList.remove('open'); // Menutup submenu jika sudah terbuka
                } else {
                    // Tutup semua submenu lain dan buka yang ini
                    submenuItems.forEach(function(subItem) {
                        subItem.classList.remove('open');
                    });
                    item.classList.add('open');
                }
            });
        });
    });
</script>
