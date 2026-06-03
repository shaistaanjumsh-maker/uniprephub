<style>
    .countMessage {
        position: absolute;
        top: -5px;
        left: 15px;
        width: 15px;
        height: 15px;
        border-radius: 50px;
        background: #ff0000;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 8px;
        text-indent: 0;
    }
</style>

@php
    $countPendingOrganizations = 0;
    $count = 0;
    if (auth()->user()->hasRole('admin') || auth()->user()->is_admin || auth()->user()->is_root) {
        $count = \App\Models\ContactMessage::where('state', 0)->count();
        $countPendingOrganizations = \App\Models\Organization::whereHas('user', function ($query) {
            $query->where('email_verified_at', null);
        })->count();
    }
@endphp

<!--Sidebar-Menu-Section-->
<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar">

        <div class="branding-logo">
            <a href="{{ auth()->user()->hasRole('admin') ? '/admin' : '/admin/dashboard' }}" target="_blank">
                <img src="{{ $app_setting['logo'] }}" alt="logo">
            </a>
        </div>

        <div class="branding-logo-forMobile mb-4">
            <a href="{{ auth()->user()->hasRole('admin') ? '/admin' : '/admin/dashboard' }}" target="_blank">
                <img src="{{ $app_setting['logo'] }}" alt="">
            </a>
        </div>

        <div class="app-sidebar-inner border-top">
            <ul class="vertical-nav-menu">


                {{-- ==================== DASHBOARD ==================== --}}
                @if (Auth::user()->hasRole('admin'))
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>

                {{-- @elseif(Auth::user()->hasRole('instructor'))
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('instructor.dashboard') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li> --}}

                @elseif(Auth::user()->hasRole('organization'))
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </li>
                    <li>
                        {{-- route('org.dashboard') exist nahi routes file mein, /org/dashboard redirect karta hai --}}
                        <a class="menu {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('org.dashboard') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/home-roof.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                @endif
                {{-- ==================== /DASHBOARD ==================== --}}


                {{-- ==================== SUBSCRIPTIONS ==================== --}}
                @can('plan.index')
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Subscriptions') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/plan*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#ordersSubscription">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/subscription_plan.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Plan Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/plan*') ? 'show' : '' }}" id="ordersSubscription">
                            <div class="listBar">
                                <a href="{{ route('admin.plan.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.plan.index', 'admin.plan.edit') ? 'active' : '' }}">
                                    {{ __('Plan List') }}
                                </a>

                                @can('plan.create')
                                    <a href="{{ route('admin.plan.create') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.plan.create') ? 'active' : '' }}">
                                        {{ __('Create New Plan') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcan

                @can('subscriber.index')
                    <li>
                        <a class="menu {{ request()->routeIs('admin.subscriber.*') ? 'active' : '' }}" href="{{ route('admin.subscriber.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/medal.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Subscriber Management') }}
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- ==================== /SUBSCRIPTIONS ==================== --}}


                {{-- ==================== COURSE ==================== --}}
                @canany(['category.index', 'course.index', 'chapter.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Course') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/category/*', 'admin/course/*', 'admin/chapter/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersCourse">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/book-open-text.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Course Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/category/*', 'admin/course/*', 'admin/chapter/*') ? 'show' : '' }}"
                            id="ordersCourse">
                            <div class="listBar">
                                @can('category.index')
                                    <a href="{{ route('admin.category.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/category/*') ? 'active' : '' }}">
                                        {{ __('Category') }}
                                    </a>
                                @endcan

                                @can('course.index')
                                    <a href="{{ route('admin.course.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/course/*') ? 'active' : '' }}">
                                        {{ __('Course') }}
                                    </a>
                                @endcan

                                    <a href="{{ route('admin.subject.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/subject/*') ? 'active' : '' }}">
                                        {{ __('Subjects') }}
                                    </a>

                                @can('course.index')
                                    <a href="{{ route('admin.premium-courses.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/premium-courses*') ? 'active' : '' }}">
                                        {{ __('Premium Courses') }}
                                    </a>
                                @endcan

                                {{-- route('chapter.select_course') exist nahi - Chapter resource route use kar rahe hain --}}
                                {{-- @can('chapter.index')
                                    <a href="{{ route('admin.chapter.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/chapter/*') ? 'active' : '' }}">
                                        {{ __('Chapter') }}
                                    </a>
                                @endcan --}}
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- ==================== /COURSE ==================== --}}


                {{-- ==================== EXAM ==================== --}}
                @canany(['exam.select_course', 'quiz.select_course'])
                    <li>
                        <a class="menu {{ request()->is('admin/exam/*', 'admin/quiz/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersExam">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/pencil-paper.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Exam Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/exam/*', 'admin/quiz/*') ? 'show' : '' }}" id="ordersExam">
                            <div class="listBar">
                                {{-- route('exam.select_course') exist nahi - resource index use kar rahe hain --}}
                                @can('exam.select_course')
                                    <a href="{{ route('admin.exam.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/exam*') ? 'active' : '' }}">
                                        {{ __('Exam') }}
                                    </a>
                                @endcan

                                {{-- route('quiz.select_course') exist nahi - resource index use kar rahe hain --}}
                                @can('quiz.select_course')
                                    <a href="{{ route('admin.quiz.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/quiz/*') ? 'active' : '' }}">
                                        {{ __('Quiz') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- ==================== /EXAM ==================== --}}

                {{-- ==================== COUPON ==================== --}}
                {{-- @canany(['coupon.index', 'coupon.create'])
                    <li>
                        <a class="menu {{ request()->is('admin/coupon/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersCoupon">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/coupon-percent.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Coupon Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/coupon/*') ? 'show' : '' }}" id="ordersCoupon">
                            <div class="listBar">
                                @can('coupon.index')
                                    <a href="{{ route('admin.coupon.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.coupon.index', 'admin.coupon.edit') ? 'active' : '' }}">
                                        {{ __('Coupon List') }}
                                    </a>
                                @endcan

                                @can('coupon.create')
                                    <a href="{{ route('admin.coupon.create') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.coupon.create') ? 'active' : '' }}">
                                        {{ __('New Coupon') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany --}}
                {{-- ==================== /COUPON ==================== --}}


                {{-- ==================== BANNER ==================== --}}
                @can('banner.index')
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Banner') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}" href="{{ route('admin.banner.index') }}">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/banner.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Banner Management') }}
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- ==================== /BANNER ==================== --}}


                {{-- ==================== STUDENT ==================== --}}
                @canany(['user.index', 'enrollment.index', 'review.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Student') }}</span>
                    </li>
                @endcanany

                @canany(['enrollment.index', 'review.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/enrollment/*', 'admin/review/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersEnrollmentReview">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/students.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Enrollment Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/enrollment/*', 'admin/review/*') ? 'show' : '' }}"
                            id="ordersEnrollmentReview">
                            <div class="listBar">
                                @can('enrollment.index')
                                    <a href="{{ route('admin.enrollment.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/enrollment/*') ? 'active' : '' }}">
                                        {{ __('Enrollment') }}
                                    </a>
                                @endcan

                                @can('review.index')
                                    <a href="{{ route('admin.review.index') }}"
                                        class="subMenu hasCount {{ request()->is('admin/review/*') ? 'active' : '' }}">
                                        {{ __('Review') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany

                @canany(['user.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/user/*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/users-group.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Students Management') }}
                            </span>
                        </a>
                    </li>
                @endcanany
                {{-- ==================== /STUDENT ==================== --}}


                {{-- ==================== INSTRUCTOR ==================== --}}
                {{-- @canany(['instructor.index', 'instructor.create'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Instructor') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/instructor/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersInstructor">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/teacher 01.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Instructor Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/instructor/*') ? 'show' : '' }}" id="ordersInstructor">
                            <div class="listBar">
                                @can('instructor.index')
                                    <a href="{{ route('admin.instructor.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.instructor.index', 'admin.instructor.edit') ? 'active' : '' }}">
                                        {{ __('Instructor List') }}
                                    </a>
                                @endcan

                                @can('instructor.create')
                                    <a href="{{ route('admin.instructor.create') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.instructor.create') ? 'active' : '' }}">
                                        {{ __('New Instructor') }}
                                    </a>
                                @endcan

                                route('instructor.featured') exist nahi routes file mein 
                                @can('instructor.featured')
                                    <a href="{{ route('admin.instructor.featured') }}"
                                        class="subMenu hasCount {{ request()->is('admin/instructor/featured*') ? 'active' : '' }}">
                                        {{ __('Featured Instructors') }}
                                    </a>
                                @endcan 
                            </div>
                        </div>
                    </li>
                @endcanany --}}
                {{-- ==================== /INSTRUCTOR ==================== --}}


                {{-- ==================== ORGANIZATIONS ==================== --}}
                {{-- Organizations routes exist nahi hain is routes file mein (AdminOrgManagementController hai lekin route name 'organizations.*' nahi) --}}
                {{-- @canany(['organizations.index', 'organizations.plan.index', 'organizations.subscribers'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Companies') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->routeIs('organizations.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersOrganization">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/org.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Organizations') }}
                                @if ($countPendingOrganizations > 0)
                                    <div class="countMessage">{{ $countPendingOrganizations }}</div>
                                @endif
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->routeIs('organizations.*') ? 'show' : '' }}" id="ordersOrganization">
                            <div class="listBar">
                                @can('organizations.index')
                                    <a href="{{ route('organizations.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.index', 'organizations.edit') ? 'active' : '' }}">
                                        {{ __('Organization List') }}
                                    </a>
                                @endcan
                                @can('organizations.plan.index')
                                    <a href="{{ route('organizations.plan.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.plan.index', 'organizations.plan.edit') ? 'active' : '' }}">
                                        {{ __('DNS Plan History') }}
                                    </a>
                                @endcan
                                @can('organizations.plan.create')
                                    <a href="{{ route('organizations.plan.create') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.plan.create') ? 'active' : '' }}">
                                        {{ __('DNS Create Plan') }}
                                    </a>
                                @endcan
                                @can('organizations.subscribers')
                                    <a href="{{ route('organizations.subscribers') }}"
                                        class="subMenu hasCount {{ request()->routeIs('organizations.subscribers') ? 'active' : '' }}">
                                        {{ __('DNS Plan Subscribers') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany --}}
                {{-- ==================== /ORGANIZATIONS ==================== --}}


                {{-- ==================== TRANSACTIONS ==================== --}}
                @canany(['transaction.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Payment & Transactions') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->routeIs('admin.transaction.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#ordersTransaction">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/invoice.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Account Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->routeIs('admin.transaction.*') ? 'show' : '' }}" id="ordersTransaction">
                            <div class="listBar">
                                <a href="{{ route('admin.transaction.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.transaction.index') ? 'active' : '' }}">
                                    {{ __('Transactions') }}
                                </a>

                                {{-- Neeche ke routes exist nahi - sirf resource routes hain (index, create, show, edit, store, update, destroy) --}}
                                {{-- <a href="{{ route('transaction.failed') }}" class="subMenu hasCount">{{ __('Failed Transactions') }}</a> --}}
                                {{-- <a href="{{ route('transaction.courses') }}" class="subMenu hasCount">{{ __('Course Purchases') }}</a> --}}
                                {{-- <a href="{{ route('transaction.invoices') }}" class="subMenu hasCount">{{ __('Invoice Wise Purchases') }}</a> --}}
                                {{-- <a href="{{ route('transaction.subscriptions') }}" class="subMenu hasCount">{{ __('Subscription Purchases') }}</a> --}}
                                {{-- <a href="{{ route('transaction.dns.plans') }}" class="subMenu hasCount">{{ __('DNS Plan Wise Purchases') }}</a> --}}
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- ==================== /TRANSACTIONS ==================== --}}


                {{-- ==================== QUERY & PROFILE MANAGEMENT ==================== --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('Query & Profile Management') }}</span>
                </li>

                @can('testimonial.index')
                    <li>
                        <a class="menu {{ request()->routeIs('admin.testimonial.*') ? 'active' : '' }}" href="{{ route('admin.testimonial.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/testimonial.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Testimonial') }}
                            </span>
                        </a>
                    </li>
                @endcan

                @can('newslatter.index')
                    <li>
                        <a class="menu {{ request()->routeIs('admin.newslatter.*') ? 'active' : '' }}" href="{{ route('admin.newslatter.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/subscription.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Newslatter Subscribers') }}
                            </span>
                        </a>
                    </li>
                @endcan

                @canany(['notification.index'])
                    <li>
                        <a class="menu {{ request()->is('admin/notification/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#notificationManagement">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/bell-on.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Notification Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/notification/*') ? 'show' : '' }}" id="notificationManagement">
                            <div class="listBar">
                                @can('notification.index')
                                    <a href="{{ route('admin.notification.index') }}"
                                        class="subMenu hasCount {{ request()->routeIs('admin.notification.index', 'admin.notification.edit') ? 'active' : '' }}">
                                        {{ __('Pre-defined Notification') }}
                                    </a>
                                @endcan

                                <a href="{{ route('admin.custom-notification.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.custom-notification.*') ? 'active' : '' }}">
                                    {{ __('Custom Notification') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany

                @can('contact.index')
                    <li>
                        <a class="menu {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}" href="{{ route('admin.contact.index') }}">
                            <span class="position-relative">
                                <img class="menu-icon" src="{{ asset('assets/images/menu/message.svg') }}" alt="icon" loading="lazy" />
                                @if ($count > 0)
                                    <div class="countMessage">{{ $count }}</div>
                                @endif
                                {{ __('Help & Support Queries') }}
                            </span>
                        </a>
                    </li>
                @endcan

                {{-- Admin Management - route('admin.index') aur route('admin.assistant.index') exist nahi --}}
                {{-- @canany('admin.index')
                    <li>
                        <a class="menu {{ request()->is('admin/root/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminManagement">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/user-settings.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Admin Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/root*') ? 'show' : '' }}" id="adminManagement">
                            <div class="listBar">
                                <a href="{{ route('admin.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/root/sup-admin/list') ? 'active' : '' }}">
                                    {{ __('Super Admin') }}
                                </a>
                                <a href="{{ route('admin.assistant.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/root/assistant-admin/list') ? 'active' : '' }}">
                                    {{ __("Associate Admin's") }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany --}}

                @canany(['admin.profile'])
                    <li>
                        <a class="menu {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.index') }}">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/icon/user-square.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Profile') }}
                            </span>
                        </a>
                    </li>
                @endcanany

                @if (!auth()->user()->hasRole('admin') && !auth()->user()->is_admin && auth()->user()->hasRole('instructor'))
                    @canany(['report.index'])
                        <li>
                            <a class="menu {{ request()->routeIs('admin.report.*') ? 'active' : '' }}"
                                href="{{ route('admin.report.index') }}">
                                <span>
                                    <img class="menu-icon" src="{{ asset('assets/images/icon/chart-pie.svg') }}" alt="icon" loading="lazy" />
                                    {{ __('Report') }}
                                </span>
                            </a>
                        </li>
                    @endcanany
                @endif
                {{-- ==================== /QUERY & PROFILE MANAGEMENT ==================== --}}


                {{-- ==================== GENERAL SETTINGS ==================== --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('General Setting') }}</span>
                </li>

                <li>
                    <a class="menu {{ request()->is('admin/setting*', 'admin/certificate/*', 'admin/permission&role/*', 'admin/language/*', 'admin/payment-gateway*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#settingManagement">
                        <span>
                            <img class="menu-icon" src="{{ asset('assets/images/menu/settings.svg') }}" alt="icon" loading="lazy" />
                            {{ __('Settings Management') }}
                        </span>
                        <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                    </a>
                    <div class="collapse dropdownMenuCollapse {{ request()->is('admin/setting*', 'admin/certificate/*', 'admin/permission&role/*', 'admin/language*', 'admin/payment-gateway*') ? 'show' : '' }}"
                        id="settingManagement">
                        <div class="listBar">
                            @can('setting.index')
                                <a href="{{ route('admin.setting.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}">
                                    {{ __('Business Settings') }}
                                </a>
                                <a href="{{ route('admin.setting.home.page.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.setting.home.page.setup') ? 'active' : '' }}">
                                    {{ __('Site Settings') }}
                                </a>
                                <a href="{{ route('admin.setting.smtp.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.setting.smtp.setup') ? 'active' : '' }}">
                                    {{ __('SMTP Settings') }}
                                </a>
                                <a href="{{ route('admin.setting.social.media.setup') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.setting.social.media.setup') ? 'active' : '' }}">
                                    {{ __('Social Media Settings') }}
                                </a>
                            @endcan

                            {{-- @can('certificate.index')
                                <a href="{{ route('admin.certificate.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/certificate*') ? 'active' : '' }}">
                                    {{ __('Certificate Configaration') }}
                                </a>
                            @endcan --}}

                            @can('role.index')
                                <a href="{{ route('admin.role.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/permission&role/*') ? 'active' : '' }}">
                                    {{ __('Role & Permission') }}
                                </a>
                            @endcan

                            {{-- route('language.index') exist nahi routes file mein --}}
                            {{-- <a href="{{ route('language.index') }}" class="subMenu hasCount">{{ __('Language') }}</a> --}}

                            {{-- route('server.index') exist nahi routes file mein --}}
                            {{-- @can('server.index')
                                <a href="{{ route('server.index') }}" class="subMenu hasCount">{{ __('Server Configuration') }}</a>
                            @endcan --}}

                            {{-- @can('payment_gateway.index')
                                <a href="{{ route('admin.payment-gateway.index') }}"
                                    class="subMenu hasCount {{ request()->is('admin/payment-gateway*') ? 'active' : '' }}">
                                    {{ __('Payment Gateway') }}
                                </a>
                            @endcan --}}
                        </div>
                    </div>
                </li>
                {{-- ==================== /GENERAL SETTINGS ==================== --}}


                {{-- ==================== INVOICE MANAGEMENT ==================== --}}
                {{-- Invoice routes exist nahi routes file mein (route('invoice.index'), route('invoice.create'), route('invoice.trash')) --}}
                {{-- @can('invoice.index')
                    <li>
                        <a class="menu {{ request()->is('admin/invoice*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#invoiceManagement">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/invoice.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Invoice Management') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/invoices*') ? 'show' : '' }}" id="invoiceManagement">
                            <div class="listBar">
                                @can('invoice.index')
                                    <a href="{{ route('invoice.index') }}" class="subMenu hasCount">{{ __('Invoices') }}</a>
                                @endcan
                                @can('invoice.create')
                                    <a href="{{ route('invoice.create') }}" class="subMenu hasCount">{{ __('Generate New Invoice') }}</a>
                                @endcan
                                @can('invoice.update')
                                    <a href="{{ route('invoice.trash') }}" class="subMenu hasCount">{{ __('Restore Invoices') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcan --}}
                {{-- ==================== /INVOICE MANAGEMENT ==================== --}}


                {{-- ==================== PAGE MANAGEMENT ==================== --}}
                @canany(['page.index'])
                    <li class="menu-divider">
                        <span class="menu-title">{{ __('Page Management') }}</span>
                    </li>
                    <li>
                        <a class="menu {{ request()->is('admin/page/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#ordersLegal">
                            <span>
                                <img class="menu-icon" src="{{ asset('assets/images/menu/file-text-shield.svg') }}" alt="icon" loading="lazy" />
                                {{ __('Legal Pages') }}
                            </span>
                            <img src="{{ asset('assets/images/menu/angle-down-small.svg') }}" alt="icon" class="downIcon" />
                        </a>
                        <div class="collapse dropdownMenuCollapse {{ request()->is('admin/page/*') ? 'show' : '' }}" id="ordersLegal">
                            <div class="listBar">
                                <a href="{{ route('admin.page.index') }}"
                                    class="subMenu hasCount {{ request()->routeIs('admin.page.index') ? 'active' : '' }}">
                                    {{ __('All Pages') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'about_us') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/about_us') ? 'active' : '' }}">
                                    {{ __('About Us') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'contact_us') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/contact_us') ? 'active' : '' }}">
                                    {{ __('Contact Us') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'faq') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/faq') ? 'active' : '' }}">
                                    {{ __('FAQ') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'privacy_policy') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/privacy_policy') ? 'active' : '' }}">
                                    {{ __('Privacy Policy') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'terms_and_conditions') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/terms_and_conditions') ? 'active' : '' }}">
                                    {{ __('Terms & Conditions') }}
                                </a>
                                <a href="{{ route('admin.page.edit', 'refund_policy') }}"
                                    class="subMenu hasCount {{ request()->is('admin/page/edit/refund_policy') ? 'active' : '' }}">
                                    {{ __('Refund Policy') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endcanany
                {{-- ==================== /PAGE MANAGEMENT ==================== --}}

                {{-- ==================== NOTES MANAGEMENT ==================== --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('Notes Management') }}</span>
                </li>
                <li>
                    <a class="menu {{ request()->is('admin/note/*') ? 'active' : '' }}" href="{{ route('admin.note.index') }}">
                        <span>
                            <img class="menu-icon" src="{{ asset('assets/images/menu/file-text-shield.svg') }}" alt="icon" loading="lazy" />
                            {{ __('Notes') }}
                        </span>
                    </a>
                </li>
                
                {{-- ==================== /NOTES MANAGEMENT ==================== --}}

                {{-- ==================== LOGOUT ==================== --}}
                <li class="menu-divider">
                    <span class="menu-title">{{ __('Sign Out') }}</span>
                </li>
                <li>
                    <a class="menu" href="{{ route('admin.logout') }}">
                        <span class="text-danger">
                            <img class="menu-icon" src="{{ asset('assets/images/menu/log-out.svg') }}" alt="icon" loading="lazy" />
                            {{ __('Logout Account') }}
                        </span>
                    </a>
                </li>
                {{-- ==================== /LOGOUT ==================== --}}


                @if (Auth::user()->hasRole('admin'))
                    <div class="sideBarfooter">
                        <a href="{{ route('admin.setting.index') }}" class="fullbtn"><i class="fa-solid fa-gear"></i></a>
                        <button type="button" class="fullbtn hite-icon" onclick="toggleFullScreen(document.body)">
                            <i class="fa-solid fa-expand"></i>
                        </button>

                        {{-- route('cache.clear') exist nahi routes file mein --}}
                        {{-- <a href="{{ route('cache.clear') }}" class="fullbtn hite-icon"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip"
                            data-bs-title="{{ __('Website Cache Clear') }}">
                            <i class="bi bi-radioactive"></i>
                        </a> --}}

                        <a href="{{ route('admin.logout') }}" class="fullbtn hite-icon">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- End-Sidebar-Menu-Section -->