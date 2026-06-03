<div class="app-header header-shadow">
    <div class="app-header-logo"></div>
    <div class="app-header-mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header-menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header-content">

        <!-- Header-Left-Section -->
        <div class="app-header-left">
            <div class="header-pane">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!-- End-Header-Left-Section -->

        <!-- Header-Welcome-Section -->
        <div class="app-header-welcome">
            @yield('header-title')
            @yield('header-sub-title')
        </div>
        <!-- End-Header-Welcome-Section -->

        <!-- Header-Right-Section -->
        <div class="app-header-right">

            {{-- Dark/Light Mode Toggle --}}
            <div class="modeButton me-3">
                <button id="modeChange" type="button" class="emailBadge position-relative">
                    <i class="bi bi-moon" id="modeIcon"></i>
                </button>
            </div>

            {{-- Notification Bell (Admin/Root only, not plain instructor) --}}
            @if (!auth()->user()->hasRole('instructor') || auth()->user()->is_admin || auth()->user()->is_root)
                <div class="badgeButtonBox me-4">
                    <div class="notifactionIcon">
                        <button type="button" class="emailBadge dropdown-toggle position-relative"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/menu/bell-on.svg') }}" alt="notification">
                            <span class="position-absolute notificationCount"
                                id="totalNotify">{{ $notificationMessages->where('is_read', 0)->count() }}</span>
                        </button>
                        <div class="dropdown-menu p-0 emailNotifactionSection">
                            <div class="dropdown-item emailNotifaction">
                                <div class="emailHeader">
                                    <h6 class="massTitel">{{ __('Notifications') }}</h6>
                                </div>
                                <div class="messege-section" id="notifications">
                                    @foreach ($notificationMessages as $notification)
                                        @php
                                            $metadata = json_decode($notification->metadata, true);
                                        @endphp
                                        <a href="javascript:void(0)" class="item d-flex gap-2 align-items-center">
                                            <div class="iconBox {{ $notification->is_read ? '' : 'pdfIcon' }}">
                                                <i class="bi bi-chat-left-text-fill"></i>
                                            </div>
                                            <div class="notification w-100 {{ $notification->is_read ? '' : 'unread' }}">
                                                <div class="userName">
                                                    <p class="massTitel">
                                                        {{ $notification->notification->heading }}
                                                    </p>
                                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div>
                                                    <p class="description">{{ $notification->content }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="emailFooter">
                                    <a class="massPera text-dark">{{ __('View All Notifications') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Language Dropdown - commented out (route 'change.language' exist nahi) --}}
            {{-- <div class="user-profile-box dropdown me-4">
                <div class="nav-profile-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    @php $selectedLang = app()->getLocale(); @endphp
                    <div class="lang">
                        <img src="{{ asset('assets/images/menu/Launguage.svg') }}" alt="icon" loading="lazy" />
                        <span>{{ $languages->where('name', $selectedLang)->first()?->title ?? $selectedLang }}</span>
                        <i class="fa-solid fa-angle-down dropIcon"></i>
                    </div>
                </div>
                <div class="dropdown-menu profile-item">
                    @foreach ($languages as $language)
                        <a href="{{ route('change.language', 'language=' . $language->name) }}"
                            class="dropdown-item {{ $language->name == app()->getLocale() ? 'language-active' : '' }}">
                            <i class="fa fa-language mr-3"></i>
                            {{ $language?->title }}
                        </a>
                    @endforeach
                </div>
            </div> --}}

            {{-- User Profile Dropdown --}}
            <div class="user-profile-box dropdown">
                <div class="nav-profile-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-content text-end">
                        <h4 class="admin-name">{{ auth()->user()?->name ?? 'User Name' }}</h4>
                        <p class="admin-role text-capitalize">
                            {{ auth()->user() ? auth()->user()->getRoleNames()->first() : 'guest' }}
                            <i class="fa-solid fa-angle-down dropIcon"></i>
                        </p>
                    </div>
                    <div class="profile-image">
                        <img class="profilepic"
                            src="{{ auth()->user()?->profilePicturePath ?? asset('assets/images/avatars/MD.png') }}"
                            alt="">
                    </div>
                </div>

                <div class="dropdown-menu profile-item">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                        <i class="fa-solid fa-chart-simple me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.user.edit', auth()->user()?->id) }}" class="dropdown-item">
                        <i class="fa-solid fa-face-smile me-2"></i>
                        {{ __('Update Profile') }}
                    </a>
                    <a href="{{ route('admin.course.index') }}" class="dropdown-item">
                        <i class="fa-solid fa-book me-2"></i>
                        {{ __('Courses') }}
                    </a>
                    <a href="{{ route('admin.setting.index') }}" class="dropdown-item">
                        <i class="fa-solid fa-gears me-2"></i>
                        {{ __('Setting') }}
                    </a>
                    <a href="/" target="_blank" class="dropdown-item">
                        <i class="fa-solid fa-globe me-2"></i>
                        {{ __('Visit Website') }}
                    </a>
                    <button onclick="toggleFullScreen(document.body)" type="button" class="dropdown-item">
                        <i class="fa-solid fa-expand me-2"></i>
                        {{ __('Full Screen') }}
                    </button>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>

        </div>
        <!-- End-Header-Right-Section -->

    </div>
</div>

{{-- Dark/Light Mode Script --}}
<script>
    const modeIcon = document.getElementById('modeIcon');
    const modeChange = document.getElementById('modeChange');

    modeChange.addEventListener('click', () => {
        if (modeIcon.classList.contains('bi-moon')) {
            modeIcon.classList.remove('bi-moon');
            modeIcon.classList.add('bi-moon-fill');
            setThemeMode('app-theme-dark');
        } else {
            modeIcon.classList.remove('bi-moon-fill');
            modeIcon.classList.add('bi-moon');
            setThemeMode('app-theme-light');
        }
    });
</script>