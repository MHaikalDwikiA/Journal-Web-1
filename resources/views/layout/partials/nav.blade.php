<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title">
                    <span>Menu</span>
                </li>
                <?php
                $menus = [
                    (object) [
                        'name' => 'Beranda',
                        'icon' => 'la la-dashboard',
                        'link' => 'dashboard',
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
                    ],
                    (object) [
                        'name' => 'Pengguna',
                        'icon' => 'la la-user-cog',
                        'link' => 'users',
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
                        'name' => 'Siswa',
                        'icon' => 'la la-graduation-cap',
                        'link' => 'students',
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
