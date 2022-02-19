<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ Storage::url(Helpers::setting('admin.logo')) }}" style="width: 33px;height: 33px;" alt="AssaPars"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Helpers::setting('admin.title') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Helpers::is_active('admin') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Ana Sayfa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('randevu.index') }}"
                        class="nav-link {{ Helpers::is_active('admin/randevu') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Randevular
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Helpers::menu_open('admin/kullanici-islemleri/*') }}">
                    <a href="#" class="nav-link {{ Helpers::is_active('admin/kullanici-islemleri/*') }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Kullanıcı İşlemleri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}"
                                class="nav-link {{ Helpers::is_active('admin/kullanici-islemleri/kullanicilar') }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Kullanıcılar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.newuser') }}"
                                class="nav-link {{ Helpers::is_active('admin/kullanici-islemleri/kullanicilar/create') }} {{ Helpers::is_active('admin/kullanici-islemleri/kullanicilar/*') }}">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Yeni Kullanıcı Ekle</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role') }}"
                                class="nav-link {{ Helpers::is_active('admin/kullanici-islemleri/roller') }}">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Roller</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role.create') }}"
                                class="nav-link {{ Helpers::is_active('admin/kullanici-islemleri/roller/create') }} {{ Helpers::is_active('admin/kullanici-islemleri/roller/*') }}">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Yeni Rol Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Helpers::menu_open('admin/sayfalar/*') }} {{ Helpers::menu_open('admin/sayfalar') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/sayfalar/*') }} {{ Helpers::is_active('admin/sayfalar') }}">
                        <i class="nav-icon fas fa-pager"></i>
                        <p>
                            Sayfa İşlemleri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.page') }}"
                                class="nav-link {{ Helpers::is_active('admin/sayfalar') }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Sayfalar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.newPage') }}"
                                class="nav-link {{ Helpers::is_active('admin/sayfalar/create') }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Yeni Sayfa Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ Helpers::menu_open('admin/urunler/*') }} {{ Helpers::menu_open('admin/urunler') }} {{ Helpers::menu_open('admin/urun-kategorileri/*') }} {{ Helpers::menu_open('admin/urun-kategorileri') }} {{ Helpers::menu_open('admin/varyantlar/*') }} {{ Helpers::menu_open('admin/varyantlar') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/urunler/*') }} {{ Helpers::is_active('admin/urunler') }} {{ Helpers::is_active('admin/urun-kategorileri/*') }} {{ Helpers::is_active('admin/urun-kategorileri') }} {{ Helpers::is_active('admin/varyantlar/*') }} {{ Helpers::is_active('admin/varyantlar') }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Ürün İşlemleri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('urunler.index') }}"
                                class="nav-link {{ Helpers::is_active('admin/urunler/*') }} {{ Helpers::is_active('admin/urunler') }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Ürünler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('urun-kategorileri.index') }}"
                                class="nav-link {{ Helpers::is_active('admin/urun-kategorileri/*') }} {{ Helpers::is_active('admin/urun-kategorileri') }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Ürün Katagorileri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('varyantlar.index') }}"
                                class="nav-link {{ Helpers::is_active('admin/varyantlar/*') }} {{ Helpers::is_active('admin/varyantlar') }}">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Kategori Varyasyonları</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('modules') }}"
                        class="nav-link {{ Helpers::is_active('admin/modules/.*') }}{{ Helpers::is_active('admin/modules') }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Modül İşlemleri
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Helpers::menu_open('admin/blog/*') }} {{ Helpers::menu_open('admin/blog') }} {{ Helpers::menu_open('admin/kategori/*') }} {{ Helpers::menu_open('admin/kategori') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/blog/*') }} {{ Helpers::is_active('admin/blog') }} {{ Helpers::is_active('admin/kategori/*') }} {{ Helpers::is_active('admin/kategori') }}">
                        <i class="nav-icon nav-icon fab fa-hive"></i>
                        <p>
                            Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs') }}"
                                class="nav-link {{ Helpers::is_active('admin/blog') }}">
                                <i class="nav-icon fab fa-hive"></i>
                                <p>Bloglar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.newBlog') }}"
                                class="nav-link {{ Helpers::is_active('admin/blog/create') }} {{ Helpers::is_active('admin/blog/*') }}">
                                <i class="nav-icon fas fa-pager"></i>
                                <p>Yeni Blog Ekle</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}"
                                class="nav-link {{ Helpers::is_active('admin/kategori') }}">
                                <i class="nav-icon far fa-clone"></i>
                                <p>Kategoriler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}"
                                class="nav-link {{ Helpers::is_active('admin/kategori/create') }} {{ Helpers::is_active('admin/kategori/*') }}">
                                <i class="nav-icon far fa-square"></i>
                                <p>Kategori Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Helpers::menu_open('admin/galeri-kategori/*') }} {{ Helpers::menu_open('admin/galeri-kategori') }} {{ Helpers::menu_open('admin/galeri/*') }} {{ Helpers::menu_open('admin/galeri') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/galeri-kategori/*') }} {{ Helpers::is_active('admin/galeri-kategori') }} {{ Helpers::is_active('admin/galeri/*') }} {{ Helpers::is_active('admin/galeri') }}">
                        <i class="nav-icon fas fa-camera-retro"></i>
                        <p>
                            Galeri
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('galeri.index') }}"
                                class="nav-link {{ Helpers::is_active('admin/galeri') }}">
                                <i class="nav-icon far fa-image"></i>
                                <p>İçerikler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('galeri-kategori.index') }}"
                                class="nav-link {{ Helpers::is_active('admin/galeri-kategori/create') }} {{ Helpers::is_active('admin/galeri-kategori') }}">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>Kategoriler</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Helpers::menu_open('admin/slider/*') }} {{ Helpers::menu_open('admin/slider') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/slider/*') }} {{ Helpers::is_active('admin/slider') }}">
                        <i class="nav-icon far fa-images"></i>
                        <p>
                            Slider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider') }}"
                                class="nav-link {{ Helpers::is_active('admin/slider') }}">
                                <i class="nav-icon far fa-images"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.newSlider') }}"
                                class="nav-link {{ Helpers::is_active('admin/slider/create') }}">
                                <i class="nav-icon far fa-image"></i>
                                <p>Yeni Slider Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Helpers::menu_open('admin/settings/*') }} {{ Helpers::menu_open('admin/settings') }}">
                    <a href="#"
                        class="nav-link {{ Helpers::is_active('admin/settings/*') }} {{ Helpers::is_active('admin/settings') }}">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            Ayarlar
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.ayarlar') }}"
                                class="nav-link {{ Helpers::is_active('admin/settings') }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                   Genel Ayarlar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('siteAyarlari') }}"
                                class="nav-link {{ Helpers::is_active('admin/slider/create') }}">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Site Ayarları</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
