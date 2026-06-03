<template>
    <section class="auth-page login-page">
        <div class="container">
            <div class="card auth-card shadow-sm border-0 rounded-4 overflow-hidden mx-auto">
                <div v-if="masterStore?.masterData?.mode == 'local'" class="version-badge">v{{ masterStore?.masterData?.version }}</div>
                <div v-if="masterStore?.masterData?.mode == 'local'" class="powerBy">Powered by RazinSoft &copy;{{ new Date().getFullYear() }}</div>

                <div class="row g-0">
                    <div class="col-lg-5 auth-panel auth-panel--hero text-white d-flex flex-column justify-content-between p-4 p-md-5">
                        <div>
                            <div class="logo-img mb-4 text-center">
                                <router-link to="/"><img :src="masterStore?.masterData?.logo" class="object-fit-cover"
                                        alt="Logo" /></router-link>
                            </div>
                            <h2 class="fw-bold mb-3">{{ $t('Welcome Back') }}</h2>
                            <p class="text-white-75 mb-4">{{ $t('Sign in to continue to your classes and course dashboard.') }}</p>
                            <ul class="feature-list list-unstyled mb-0">
                                <li>{{ $t('Fast access to your dashboard') }}</li>
                                <li>{{ $t('Stay on top of your courses') }}</li>
                                <li>{{ $t('Secure and simple login') }}</li>
                            </ul>
                        </div>
                        <div class="auth-hero-footer mt-4">
                            <p class="mb-2 text-white-75">{{ $t("Don't have an account?") }}</p>
                            <router-link to="/register" class="btn btn-outline-light rounded-pill px-4">{{ $t('Sign Up') }}</router-link>
                        </div>
                    </div>

                    <div class="col-lg-7 auth-panel auth-panel--form p-4 p-md-5 bg-white">
                        <div class="mb-4">
                            <h3 class="fw-bold mb-2">{{ $t('Login') }}</h3>
                            <p class="text-muted mb-0">{{ $t('Boost your skill always and forever') }}.</p>
                        </div>

                        <form class="auth-form-fields" @submit.prevent="loginUser">
                            <div class="mb-4">
                                <input type="email" v-model="email" class="form-control"
                                    :placeholder="$t('Email Address')" />
                                <p v-if="errors.email" class="text-danger fw-bold mt-2">{{ errors.email[0] }}</p>
                            </div>
                            <div class="mb-3 position-relative">
                                <input :type="showPassword ? 'text' : 'password'" v-model="password"
                                    class="form-control" :placeholder="$t('Password')" />
                                <p v-if="errors.password" class="text-danger fw-bold mt-2">{{ errors.password[0] }}</p>
                                <div class="eye-icon" @click="showPassword = !showPassword">
                                    <FontAwesomeIcon :icon="showPassword ? faEye : faEyeSlash" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <router-link to="/reset_password" class="small text-decoration-none">{{ $t('Forgot your password') }}?</router-link>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-2 mb-3">
                                <span :class="{ 'loader': loader }">{{ loginBtnText }}</span>
                            </button>
                        </form>

                        <div class="text-center my-3">
                            <span class="text-muted">{{ $t('or') }}</span>
                        </div>

                        <a href="/auth/google" class="btn btn-outline-danger w-100 rounded-2 mb-3">
                            {{ $t('Continue with Google') }}
                        </a>

                        <p class="text-center text-muted mb-3">{{ $t("Don't have an account") }}?
                            <router-link to="/register">{{ $t('Sign Up') }}</router-link>
                        </p>

                        <div v-if="masterStore?.masterData?.mode == 'local'"
                            class="border p-3 d-flex flex-wrap gap-3 align-items-center justify-content-between rounded-4 my-3">
                            <div>
                                <strong>{{ $t('Email') }}:</strong> user@readylms.com <br>
                                <strong>{{ $t('Password') }}:</strong> secret@123
                            </div>
                            <button @click="copyDemoCredentials('user@readylms.com', 'secret@123')"
                                class="btn btn-sm btn-outline-primary small">{{ $t('Copy') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
.auth-page {
    min-height: 100vh;
    background: linear-gradient(180deg, rgba(62, 52, 135, 0.9), rgba(47, 56, 132, 0.9)), url('/public/assets/website/authorization-page.png') no-repeat center;
    background-size: cover;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.auth-card {
    max-width: 960px;
    border: none;
    overflow: hidden;
    position: relative;
}

.auth-panel--hero {
    background: linear-gradient(135deg, #673dff, #4b56f1);
}

.auth-panel--hero .logo-img {
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.12);
    padding: 1.5rem 0;
    border-radius: 1rem;
}

.auth-panel--hero .logo-img img {
    max-width: 200px;
    max-height: 75px;
    object-fit: contain;
}

.auth-panel--hero h2 {
    font-size: 2rem;
}

.feature-list {
    color: rgba(255, 255, 255, 0.9);
    margin-top: 1rem;
}

.feature-list li {
    margin-bottom: 0.8rem;
    position: relative;
    padding-left: 1.5rem;
}

.feature-list li::before {
    content: "";
    width: 8px;
    height: 8px;
    background: #ffd166;
    border-radius: 50%;
    position: absolute;
    left: 0;
    top: 0.7rem;
}

.auth-panel--form {
    min-height: 100%;
}

.auth-form-fields input {
    height: 50px;
    border-radius: 0.75rem;
    padding: 0.9rem 1rem;
}

.auth-form-fields input.is-invalid {
    border-color: #dc3545;
}

.auth-form-fields .form-check-label {
    font-size: 0.9rem;
}

.eye-icon {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
}

.auth-hero-footer {
    border-top: 1px solid rgba(255, 255, 255, 0.12);
    padding-top: 1.5rem;
}

.auth-panel--form .logo-img {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f9fbff;
    padding: 1.5rem 0;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
}

.auth-panel--form .logo-img img {
    max-width: 220px;
    max-height: 90px;
    object-fit: cover;
}

.auth-panel--form .btn-primary {
    padding: 0.95rem 1.25rem;
    font-weight: 600;
}

.auth-panel--form .btn-outline-danger {
    border-width: 2px;
}

.version-badge,
.powerBy {
    position: absolute;
    background-color: #9e4aed;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 18px;
    border-radius: 0 0 0.75rem 0;
    z-index: 1;
}

.version-badge {
    top: 0;
    right: 0;
}

.powerBy {
    bottom: 0;
    right: 0;
}

@media (max-width: 992px) {
    .auth-card {
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .auth-page {
        padding: 1rem 0;
    }

    .auth-panel--hero,
    .auth-panel--form {
        border-radius: 0 !important;
    }
}

@media (max-width: 576px) {
    .auth-panel--hero {
        min-height: auto;
    }

    .auth-form-fields input {
        height: 48px;
    }
}
</style>

<script setup>
import axios from "axios";
import Swal from "sweetalert2";
import { onMounted, ref, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import { useI18n } from "vue-i18n";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowLeft, faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";

let errors = ref("");
const loader = ref(false);

const router = useRouter();
const route = useRoute();
const authStore = useAuthStore();
const masterStore = useMasterStore();

const email = ref("");
const password = ref("");
const loginBtnText = ref("Sign in");
const { t } = useI18n();
let showPassword = ref(false);

// Function to handle login
const loginUser = async () => {
    try {
        loader.value = true;
        loginBtnText.value = "Signing in...";
        const response = await axios.post(`/login`, {
            email: email.value,
            password: password.value,
        });

        // Store user data and auth token in state
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );

        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Login successful",
            showConfirmButton: false,
            timer: 1500,
        });

        // Redirect to dashboard or other page
        if (localStorage.getItem("handle_course_id")) {
            router.push("/checkout/" + localStorage.getItem("handle_course_id"));
            localStorage.removeItem("handle_course_id");
        } else {
            router.push("/dashboard");
        }

    } catch (error) {
        loader.value = false;
        if (error?.response?.data.errors) {
            errors.value = error?.response?.data.errors;
        } else {
            errors.value = error?.response?.data.message;
        }

        loginBtnText.value = "Sign in";

        if (error?.response?.status === 403) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:
                    error.response?.data?.message ||
                    "Login failed. Please try again.",
            });
        }
    }
};


const copyDemoCredentials = (demoEmail, demoPassword) => {
    email.value = demoEmail
    password.value = demoPassword

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: t("Demo credentials copied Successfully!!")
    });
}


onMounted(async () => {
    if (!masterStore.data) {
        axios
            .get(`/master`, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            })
            .then((response) => {
                masterStore.setMasterData(response.data.data.master);
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }

    if (route.query.social_error) {
        Swal.fire({
            icon: "error",
            title: "Authentication Error",
            text: route.query.social_error,
        });
    }
})

</script>
