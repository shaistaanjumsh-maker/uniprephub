<template>
    <topHeader/>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <router-link to="/" class="navbar-brand">
                <img :src="masterStore?.masterData?.logo" width="150px" height="50px" class="object-fit-contain"
                    alt="UnivPrepHub" />
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarContent">
                <ul class="navbar-nav mb-2 mb-lg-0">

                    <!-- Home -->
                    <li class="nav-item">
                        <router-link to="/" :class="['nav-link', $route.path === '/' ? 'active' : '']">
                            <i class="bi bi-house-door me-1"></i>{{ $t('Home') }}
                        </router-link>
                    </li>

                    <!-- Premium Courses -->
                    <li class="nav-item">
                        <router-link to="/premium" :class="['nav-link', $route.path === '/premium' ? 'active' : '']">
                            <i class="bi bi-star-fill me-1"></i>{{ $t('Premium Courses') }}
                        </router-link>
                    </li>

                    <!-- Notes -->
                    <li class="nav-item">
                        <router-link to="/notes" :class="['nav-link', $route.path === '/notes' ? 'active' : '']">
                            <i class="bi bi-journal-text me-1"></i>{{ $t('Notes') }}
                        </router-link>
                    </li>

                    <!-- Learning Videos (external) -->
                    <li class="nav-item">
                        <a href="https://www.youtube.com/@univprephub8288" target="_blank" rel="noopener noreferrer" class="nav-link">
                            <i class="bi bi-play-circle me-1"></i>{{ $t('Learning Videos') }}
                        </a>
                    </li>

                    <!-- About Us -->
                    <li class="nav-item">
                        <router-link to="/about-us" :class="['nav-link', $route.path === '/about-us' ? 'active' : '']">
                            <i class="bi bi-info-circle me-1"></i>{{ $t('About Us') }}
                        </router-link>
                    </li>

                    <!-- Contact Us -->
                    <li class="nav-item">
                        <router-link to="/contact-us" :class="['nav-link', $route.path === '/contact-us' ? 'active' : '']">
                            <i class="bi bi-envelope me-1"></i>{{ $t('Contact Us') }}
                        </router-link>
                    </li>

                    <!-- Logged In: Profile Dropdown -->
                    <li v-if="authStore.authToken" class="nav-item d-flex align-items-center ms-md-3">
                        <div class="dropdown">
                            <button class="btn profile-btn d-flex align-items-center gap-2" type="button"
                                id="profileDropdown" data-bs-toggle="dropdown">
                                <img :src="authStore.userData.profile_picture" alt="Profile" class="profile-img" />
                                <i class="bi bi-chevron-down" style="font-size: 11px; color: #888;"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow-lg rounded-3 mt-2"
                                aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex align-items-center gap-2 pb-2">
                                    <img :src="authStore.userData.profile_picture" alt="Profile" width="36" height="36"
                                        class="rounded-circle object-fit-cover" />
                                    <div>
                                        <div class="fw-bold" style="font-size: 13px;">{{ authStore.userData.name }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ authStore.userData.email }}</div>
                                    </div>
                                </div>
                                <div class="dropdown-divider mt-0"></div>
                                <router-link to="/dashboard" class="dropdown-item d-flex align-items-center gap-2">
                                    <i class="bi bi-speedometer2"></i> {{ $t('Dashboard') }}
                                </router-link>
                                <router-link to="/dashboard/profile" class="dropdown-item d-flex align-items-center gap-2">
                                    <i class="bi bi-person"></i> {{ $t('Profile') }}
                                </router-link>
                                <router-link to="/dashboard/courses" class="dropdown-item d-flex align-items-center gap-2">
                                    <i class="bi bi-collection-play"></i> {{ $t('My Courses') }}
                                </router-link>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item text-danger d-flex align-items-center gap-2" @click="logout()">
                                    <i class="bi bi-box-arrow-right"></i> {{ $t('Logout') }}
                                </button>
                            </div>
                        </div>
                    </li>

                    <!-- Not Logged In: Login + Register -->
                    <li v-else class="nav-item d-flex align-items-center gap-2 ms-md-3">
                        <router-link to="/login" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                            {{ $t('Login') }}
                        </router-link>
                        <router-link to="/register" class="btn btn-primary btn-sm px-3 rounded-pill text-white">
                            {{ $t('Register') }}
                        </router-link>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.navbar {
    transition: all 0.3s ease;
    background-color: #ffffff;
    box-shadow: 0 2px 12px rgba(95, 45, 237, 0.07);
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.6rem;
    color: #563d7c;
    transition: color 0.3s;
}

.navbar-brand:hover {
    color: #b54dff;
}

.nav-link {
    font-size: 0.82rem;
    color: #555;
    font-weight: 500;
    padding: 6px 4px;
    margin: 0 1px;
    position: relative;
    transition: color 0.3s;
    white-space: nowrap;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2.5px;
    bottom: 0;
    left: 0;
    background-color: #b54dff;
    border-radius: 2px;
    transition: width 0.3s;
}

.nav-link.active {
    color: #b54dff;
}

.nav-link.active::after {
    width: 100%;
}

.nav-link:hover {
    color: #b54dff;
}

.nav-link:hover::after {
    width: 100%;
}

.navbar-nav {
    display: flex;
    align-items: center;
    gap: 6px;
}

.profile-btn {
    background: transparent;
    border: none;
    padding: 4px 6px;
    border-radius: 30px;
    transition: background 0.2s;
}

.profile-btn:hover {
    background: rgba(95, 45, 237, 0.06);
}

.profile-img {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #b54dff;
}

.dropdown-menu {
    min-width: 200px;
    border: 1px solid rgba(95, 45, 237, 0.1);
}

.dropdown-item {
    font-size: 13.5px;
    padding: 8px 16px;
    color: #444;
    transition: background 0.2s, color 0.2s;
}

.dropdown-item:hover {
    background: rgba(95, 45, 237, 0.06);
    color: #7c3aed;
}

.dropdown-header {
    padding: 12px 16px 8px;
}

.navbar-toggler {
    border: none;
    outline: none;
    box-shadow: none;
}

/* ===== MOBILE ===== */
@media (max-width: 991.98px) {
    #navbarContent {
        background: #fff;
        text-align: center;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-10px);
        opacity: 0;
        transition: all 0.4s ease-in-out;
        margin-top: 8px;
    }

    .collapse.show#navbarContent {
        transform: translateY(0);
        opacity: 1;
    }

    #navbarContent .navbar-nav {
        flex-direction: column;
        gap: 4px;
        width: 100%;
    }

    #navbarContent .nav-item {
        width: 100%;
    }

    #navbarContent .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 11px 16px;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.25s ease;
    }

    #navbarContent .nav-link:hover {
        background: rgba(181, 77, 255, 0.07);
        color: #b54dff;
        transform: translateX(3px);
    }

    #navbarContent .nav-link.active {
        background: rgba(181, 77, 255, 0.1);
        color: #b54dff;
    }

    #navbarContent .nav-link::after {
        display: none;
    }

    #navbarContent .nav-item:last-child {
        flex-direction: row;
        justify-content: center;
        margin-top: 6px;
        padding-top: 10px;
        border-top: 1px solid rgba(0,0,0,0.07);
    }
}
</style>

<script setup>
import topHeader from "./top-header.vue";
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import Swal from "sweetalert2";
import { ref, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";
import { useI18n } from "vue-i18n";

const router = useRouter();
const authStore = useAuthStore();
const masterStore = useMasterStore();
const isScrolled = ref(false);
const { t } = useI18n();

const handleScroll = () => {
    isScrolled.value = window.scrollY > 0;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

function logout() {
    Swal.fire({
        title: t("Are you sure?"),
        text: t("Do you want to log out?"),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: t("Yes, log out!"),
        cancelButtonText: t("No"),
    }).then((result) => {
        if (result.isConfirmed) {
            authStore.clearAuthData();
            Swal.fire({
                title: t("Logged Out!"),
                text: t("Log out successful."),
                showConfirmButton: false,
                icon: "success",
                timer: 1500,
            });
        }
        router.push("/");
    });
}
</script>