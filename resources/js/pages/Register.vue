<template>
    <section class="auth-page register-page">
        <div class="container">
            <div class="card auth-card shadow-sm border-0 rounded-4 overflow-hidden mx-auto">
                <div v-if="masterStore?.masterData?.mode == 'local'" class="version-badge">v{{ masterStore?.masterData?.version }}</div>
                <div v-if="masterStore?.masterData?.mode == 'local'" class="powerBy">Powered by Uniprep &copy;{{ new Date().getFullYear() }}</div>

                <div class="row g-0 ">
                    <div class="col-lg-4 auth-panel auth-panel--hero text-white d-flex flex-column justify-content-between p-4 p-md-5">
                        <div>
                            <div class="logo-img mb-4 text-center">
                                <router-link to="/"><img :src="masterStore?.masterData?.logo" class="object-fit-cover"
                                        alt="Logo" /></router-link>
                            </div>
                            <h2 class="fw-bold mb-3">{{ $t('Create your account') }}</h2>
                            <p class="text-white-75 mb-4">{{ $t('Join thousands of learners and access expert-led courses, live classes, and personalized guidance.') }}</p>
                            <ul class="feature-list list-unstyled mb-0">
                                <li>{{ $t('Interactive lessons') }}</li>
                                <li>{{ $t('Expert instructors') }}</li>
                                <li>{{ $t('Secure account setup') }}</li>
                            </ul>
                        </div>
                        <div class="auth-hero-footer mt-4">
                            <p class="mb-2 text-white-75">{{ $t('Already have an account?') }}</p>
                            <router-link to="/login" class="btn btn-outline-light rounded-pill px-4">{{ $t('Log in') }}</router-link>
                        </div>
                    </div>

                    <div class="col-lg-8 auth-panel auth-panel--form p-4 p-md-5 bg-white">
                        <div class="mb-4">
                            <h3 class="fw-bold mb-2">{{ $t('Sign up') }}</h3>
                            <p class="text-muted mb-0">{{ $t('Boost your skill always and shasta forever') }}.</p>
                        </div>

                        <form class="auth-form-fields" @submit.prevent="registerUser">
                            <div class="mb-3">
                                <input type="text" v-model="name" :class="errors?.name ? 'is-invalid form-control' : 'form-control'"
                                    placeholder="{{ $t('Full Name') }}" />
                                <p v-if="errors?.name" class="my-2 text-danger">{{ errors?.name[0] }}</p>
                            </div>

                            <div class="row gx-3">
                                <div class="col-sm-6 mb-3">
                                    <input type="tel" v-model="phone" :class="errors?.phone ? 'is-invalid form-control' : 'form-control'"
                                        placeholder="{{ $t('Phone Number') }}" />
                                    <p v-if="errors?.phone" class="my-2 text-danger">{{ errors?.phone[0] }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <input type="email" v-model="email" :class="errors?.email ? 'is-invalid form-control' : 'form-control'"
                                        placeholder="{{ $t('Email') }}" />
                                    <p v-if="errors?.email" class="my-2 text-danger">{{ errors?.email[0] }}</p>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-sm-6 mb-3 position-relative">
                                    <input :type="showPassword ? 'text' : 'password'" v-model="password"
                                        :class="errors?.password ? 'is-invalid form-control' : 'form-control'"
                                        placeholder="{{ $t('Create Password') }}" />
                                    <p v-if="errors?.password" class="my-2 text-danger">{{ errors?.password[0] }}</p>
                                    <div class="eye-icon" @click="showPassword = !showPassword">
                                        <FontAwesomeIcon :icon="showPassword ? faEye : faEyeSlash" />
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3 position-relative">
                                    <input :type="showConfirmPassword ? 'text' : 'password'" v-model="passwordConfirm"
                                        class="form-control" placeholder="{{ $t('Confirm Password') }}" />
                                    <div class="eye-icon" @click="showConfirmPassword = !showConfirmPassword">
                                        <FontAwesomeIcon :icon="showConfirmPassword ? faEye : faEyeSlash" />
                                    </div>
                                </div>
                            </div>

                             <div class="mt-2 mb-4 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                required />
                                            <label class="form-check-label text-muted" for="exampleCheck1"
                                                style="font-size: 14px;">
                                                {{ $t('I accept and agree to the') }}
                                                <button type="button" data-bs-toggle="modal" @click="terms"
                                                    data-bs-target="#termsModal"
                                                    class="text-decoration-none bg-transparent border-0 text-primary">
                                                    {{ $t('Terms & Condition') }}</button>
                                                {{ $t('and') }}
                                                <button type="button" @click="policy" data-bs-toggle="modal"
                                                    data-bs-target="#policyModal"
                                                    class="text-decoration-none bg-transparent border-0 text-primary">
                                                    {{ $t('Privacy Policy') }}</button>
                                                {{ $t('of') }} {{ masterStore?.masterData?.name }}
                                            </label>
                                        </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-2">
                                <span :class="{ 'loader': loader }">{{ signUpBtnText }}</span>
                            </button>
                        </form>

                        <div class="text-center my-3">
                            <span class="text-muted">{{ $t('or') }}</span>
                        </div>

                        <a href="/auth/google" class="btn btn-outline-danger w-100 rounded-2 mb-3">
                            {{ $t('Continue with Google') }}
                        </a>

                        <p class="text-center text-muted mb-0">{{ $t('Already have an account') }}?
                            <router-link to="/login">{{ $t('Log in') }}</router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- policy Modal -->
    <div class="modal fade" id="policyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $t('Privacy Policy') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-html="termsPage?.content"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- terms Modal -->
    <div class="modal fade" id="termsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $t('Terms & Condition') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p v-html="policyPage?.content"></p>
                </div>
            </div>
        </div>
    </div>
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
import { ref, watch, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowLeft, faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";

const router = useRouter();
const authStore = useAuthStore();
const masterStore = useMasterStore();
const policyPage = ref(null);
const termsPage = ref(null);
let showPassword = ref(false);
let showConfirmPassword = ref(false);



const policy = () => {
    policyPage.value = masterStore.masterData.pages[0];
}
const terms = () => {
    termsPage.value = masterStore.masterData.pages[1];
}

const name = ref("");
const phone = ref("");
const email = ref("");
const password = ref("");
const passwordConfirm = ref("");

// Watchers to clear errors when user inputs data
watch(name, (newValue) => {
    errors.value.name = newValue ? "" : errors.value.name; // Only clear if there's a value
});
watch(phone, (newValue) => {
    errors.value.phone = newValue ? "" : errors.value.phone;
});
watch(email, (newValue) => {
    errors.value.email = newValue ? "" : errors.value.email;
});
watch(password, (newValue) => {
    errors.value.password = newValue ? "" : errors.value.password;
});
watch(passwordConfirm, (newValue) => {
    errors.value.password_confirmation = newValue
        ? ""
        : errors.value.password_confirmation;
});

// for errors
let errors = ref();

const signUpBtnText = ref("Sign up");
const loader = ref(false);

// Function to handle user registration
const registerUser = async () => {
    try {
        loader.value = true;
        signUpBtnText.value = "Signing up...";
        const response = await axios.post(`/register`, {
            name: name.value,
            phone: phone.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirm.value,
        });
        // Store user data and auth token in Pinia store
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Registration successful",
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
        signUpBtnText.value = "Sign up";
        errors.value = error.response?.data?.errors;
    }
};

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
})


</script>
