<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title">
                    <span>Menu</span>
                </li>
                @if (Auth::user()->role)
                    @if (Auth::user()->role == App\Enums\UserRole::Admin)
                        <?php
                        $menus = [
                            (object) [
                                'name' => 'Beranda',
                                'icon' => 'la la-dashboard',
                                'link' => 'dashboard',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Pengguna',
                                'icon' => 'la la-user-cog',
                                'link' => 'users',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Sekolah',
                                'icon' => 'la la-school',
                                'link' => 'school',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Perusahaan',
                                'icon' => 'la la-building',
                                'link' => 'companies',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Tahun Pelajaran',
                                'icon' => 'la la-calendar',
                                'link' => 'school-years',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Kelas',
                                'icon' => 'la la-landmark',
                                'link' => 'classrooms',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Pembimbing Perusahaan',
                                'icon' => 'la la-user-tie',
                                'link' => 'company-advisors',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Pembimbing Sekolah',
                                'icon' => 'la la-user',
                                'link' => 'school-advisors',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Pengumuman',
                                'icon' => 'la la-bullhorn',
                                'link' => 'announcements',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Daftar PKL',
                                'icon' => 'la la-book',
                                'link' => 'internships',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Persetujuan Data Siswa',
                                'icon' => 'la la-folder',
                                'link' => 'studentDrafts',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Aspek Penilaian',
                                'icon' => 'la la-certificate',
                                'link' => 'aspects',
                                'childs' => [],
                            ],
                            (object) [
                                'title' => 'Akun',
                            ],
                            (object) [
                                'name' => 'Profil',
                                'icon' => 'la la-cog',
                                'link' => 'profile',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Logout',
                                'icon' => 'la la-sign-out-alt',
                                'link' => 'logout',
                                'childs' => [],
                            ],
                        ];
                        ?>
                    @endif
                    @if (Auth::user()->role == App\Enums\UserRole::CompanyAdvisor)
                        <?php
                        $menus = [
                            (object) [
                                'name' => 'Beranda',
                                'icon' => 'la la-dashboard',
                                'link' => 'dashboard',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Jurnal siswa',
                                'icon' => 'la la-book',
                                'link' => 'journals',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Saran siswa',
                                'icon' => 'la la-list',
                                'link' => 'suggestions',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Aspek Penilaian',
                                'icon' => 'la la-certificate',
                                'link' => 'aspects',
                                'childs' => [],
                            ],
                            (object) [
                                'title' => 'Akun',
                            ],
                            (object) [
                                'name' => 'Profil',
                                'icon' => 'la la-cog',
                                'link' => 'profile',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Logout',
                                'icon' => 'la la-sign-out-alt',
                                'link' => 'logout',
                                'childs' => [],
                            ],
                        ];
                        ?>
                    @endif

                    @if (Auth::user()->role == App\Enums\UserRole::SchoolAdvisor)
                        <?php
                        $menus = [
                            (object) [
                                'name' => 'Beranda',
                                'icon' => 'la la-dashboard',
                                'link' => 'dashboard',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Jurnal siswa',
                                'icon' => 'la la-book',
                                'link' => 'journals',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Aspek Penilaian',
                                'icon' => 'la la-certificate',
                                'link' => 'aspects',
                                'childs' => [],
                            ],
                            (object) [
                                'title' => 'Akun',
                            ],
                            (object) [
                                'name' => 'Profil',
                                'icon' => 'la la-cog',
                                'link' => 'profile',
                                'childs' => [],
                            ],
                            (object) [
                                'name' => 'Logout',
                                'icon' => 'la la-sign-out-alt',
                                'link' => 'logout',
                                'childs' => [],
                            ],
                        ];
                        ?>
                    @endif

                @endif
                @foreach ($menus as $menu)
                    @if (isset($menu->title))
                        <li class="menu-title">
                            <span>{{ $menu->title }}</span>
                        </li>
                        @continue
                    @endif
                    <li class="{{ !count($menu->childs) && Request::is($menu->link . '*') ? 'active' : '' }}">
                        <a href="{{ count($menu->childs) ? '#' : url($menu->link) }}">
                            <i class="{{ $menu->icon }}"></i>
                            <span> {{ $menu->name }}</span>
                            @if (count($menu->childs))
                                <span class="menu-arrow"></span>
                            @endif
                        </a>
                        @if (count($menu->childs))
                            <ul style="display: none">
                                @foreach ($menu->childs as $child)
                                    <li>
                                        <a class="{{ Request::is($child->link) ? 'active' : '' }}"
                                            href="{{ url($menu->link . '/' . $child->link) }}">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->

{{-- (object) [
    'name' => 'Menu',
    'icon' => 'la la-calendar',
    'link' => 'menu-path',
    'childs' => [
        (object) [
            'name' => 'Sub menu 1',
            'link' => 'sub-menu-1-path',
        ],
        (object) [
            'name' => 'Sub menu 2',
            'link' => 'sub-menu-2-path',
        ],
    ],
], --}}
