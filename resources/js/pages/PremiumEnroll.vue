<template>
    <section class="py-5" style="background: #F8FAFC; min-height: 100vh;">
        <div class="container">
            <div v-if="loading" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <div v-else-if="course">

                <!-- HERO BANNER -->
                <div class="mb-4 position-relative">
                    <img
                        v-if="course.thumbnail_url"
                        :src="course.thumbnail_url"
                        class="w-100 hero-banner rounded-4"
                        alt="Course Banner"
                    />
                    <div
                        v-else
                        class="hero-banner-fallback rounded-4 d-flex align-items-center justify-content-center"
                    >
                        <div class="text-center text-white px-4">
                            <i class="bi bi-mortarboard-fill mb-3" style="font-size:3rem;"></i>
                            <h2 class="fw-bold mb-0">{{ course.topic_name }}</h2>
                        </div>
                    </div>
                    <!-- Subject badge over banner -->
                    <span class="badge badge-teal position-absolute top-0 start-0 m-3 fs-6 px-3 py-2">
                        {{ course.subject_name }}
                    </span>
                </div>

                <div class="row g-4">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h1 class="fw-bold mb-2">{{ course.topic_name }}</h1>
                            <p class="text-muted lh-lg mb-4">{{ course.description }}</p>

                            <!-- What You Get -->
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-gift-fill text-primary me-2"></i>
                                {{ $t('What You Get') }}
                            </h5>
                            <div class="row g-2 mb-4">
                                <div class="col-6" v-for="item in features" :key="item">
                                    <div class="feature-pill d-flex align-items-center gap-2 p-2 rounded-3">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span class="fw-500 small">{{ item }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Video + PDF buttons -->
                            <div class="row gx-3 gy-3" v-if="course.video_url || course.pdf_url">
                                <div class="col-12 col-md-6" v-if="course.video_url">
                                    <button
                                        type="button"
                                        class="btn btn-outline-primary w-100 rounded-pill py-2"
                                        @click="openVideo"
                                    >
                                        <i class="bi bi-play-circle-fill me-2"></i>
                                        {{ $t('Watch Video') }}
                                    </button>
                                </div>
                                <div class="col-12 col-md-6" v-if="course.pdf_url">
                                    <button
                                        v-if="authStore.userData && enrolled"
                                        type="button"
                                        class="btn btn-outline-success w-100 rounded-pill py-2"
                                        @click="viewPdf"
                                    >
                                        <i class="bi bi-file-pdf me-2"></i>
                                        {{ $t('View PDF') }}
                                    </button>
                                    <button
                                        v-else-if="authStore.userData && !enrolled"
                                        type="button"
                                        class="btn btn-outline-secondary w-100 rounded-pill py-2"
                                        disabled
                                    >
                                        <i class="bi bi-lock-fill me-2"></i>
                                        {{ $t('Enroll to Access PDF') }}
                                    </button>
                                    <button
                                        v-else
                                        type="button"
                                        class="btn btn-outline-secondary w-100 rounded-pill py-2"
                                        disabled
                                    >
                                        <i class="bi bi-lock-fill me-2"></i>
                                        {{ $t('Login to Access PDF') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 80px; border-top: 4px solid #20c997 !important;">

                            <!-- Price — only here, once -->
                            <div class="text-center mb-4">
                                <p class="text-muted small mb-1">{{ $t('Course Fee') }}</p>
                                <h2 class="fw-bold text-success mb-0">
                                    ₹ {{ formatPrice(course.price) }}/-
                                </h2>
                            </div>

                            <hr class="my-3" />

                            <!-- Course info -->
                            <div class="mb-3">
                                <p class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                                    <i class="bi bi-bookmark-fill"></i>
                                    {{ course.topic_name }}
                                </p>
                                <div class="info-row mb-2">
                                    <i class="bi bi-clock-fill text-muted me-2"></i>
                                    <span class="small"><strong>{{ $t('Duration') }}:</strong> {{ $t('Till exam') }}</span>
                                </div>
                                <div class="info-row mb-3">
                                    <i class="bi bi-list-check text-muted me-2"></i>
                                    <span class="small"><strong>{{ $t('Syllabus') }}:</strong> {{ $t('Complete JMI Entrance Exam') }}</span>
                                </div>
                                <div class="features-mini">
                                    <div class="mb-1 small" v-for="item in features" :key="item">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>{{ item }}
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3" />

                            <!-- Enroll Button -->
                            <button
                                v-if="!authStore.userData"
                                @click="promptLogin"
                                class="btn btn-primary rounded-pill w-100 mb-2 fw-bold py-2"
                            >
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                {{ $t('Login to Enroll') }}
                            </button>
                            <button
                                v-else-if="enrolled"
                                class="btn btn-success rounded-pill w-100 mb-2 fw-bold py-2"
                                disabled
                            >
                                <i class="bi bi-check2 me-2"></i>
                                {{ $t('Already Enrolled') }} ✓
                            </button>
                            <button
                                v-else
                                @click="enrollCourse"
                                class="btn btn-success rounded-pill w-100 mb-2 fw-bold py-2"
                                :disabled="store.loading"
                            >
                                <i class="bi bi-check-circle me-2"></i>
                                {{ store.loading ? $t('Enrolling...') : $t('Enroll Now') }}
                            </button>
                            <button
                                @click="goBack"
                                class="btn btn-outline-secondary rounded-pill w-100 py-2"
                            >
                                <i class="bi bi-arrow-left me-2"></i>
                                {{ $t('Back to Courses') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT SECTION -->
                <div class="row mt-5">
                    <div class="col-lg-8 mx-auto">
                        <div class="payment-card rounded-4 p-5 text-center">
                            <h4 class="fw-bold mb-1">
                                <i class="bi bi-credit-card-fill me-2 text-primary"></i>
                                {{ $t('Payment Details') }}
                            </h4>
                            <p class="text-muted mb-4">
                                {{ $t('Scan the QR code or use the UPI ID below') }}
                            </p>

                            <div class="upi-box rounded-3 p-3 mb-4 d-inline-block">
                                <p class="mb-1 text-muted small">UPI ID</p>
                                <h5 class="fw-bold text-danger mb-0">{{ course.upi_id || 'Contact Admin' }}</h5>
                            </div>

                            <div class="amount-box rounded-3 p-4 mb-4">
                                <p class="text-muted small mb-1">{{ $t('Amount Due') }}</p>
                                <h3 class="fw-bold text-success mb-0">
                                    ₹ {{ formatPrice(course.price) }}/-
                                </h3>
                            </div>

                            <button class="btn btn-primary px-5 rounded-pill fw-bold mb-5" @click="showQR">
                                <i class="bi bi-qr-code me-2"></i>
                                {{ $t('Get QR Code') }}
                            </button>

                            <!-- Steps -->
                            <div class="steps-box rounded-3 p-4 text-start mx-auto" style="max-width:380px;">
                                <h6 class="fw-bold mb-3">{{ $t('Follow these steps') }}:</h6>
                                <div class="step-item mb-3 d-flex align-items-start gap-3">
                                    <span class="step-num">1</span>
                                    <p class="mb-0 small">{{ $t('Make the payment using UPI ID or QR code') }}</p>
                                </div>
                                <div class="step-item mb-3 d-flex align-items-start gap-3">
                                    <span class="step-num">2</span>
                                    <p class="mb-0 small">{{ $t('Take a screenshot of the payment receipt') }}</p>
                                </div>
                                <div class="step-item d-flex align-items-start gap-3">
                                    <span class="step-num">3</span>
                                    <p class="mb-0 small">
                                        {{ $t('Send the screenshot to us on') }}
                                        <a href="https://wa.me/919891460883"
                                            target="_blank"
                                            class="btn btn-success btn-sm rounded-pill px-3 ms-1"
                                        >
                                            <i class="bi bi-whatsapp me-1"></i>WhatsApp
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <hr class="mt-4 mb-3" />
                            <p class="text-muted small mb-0">
                                <i class="bi bi-telephone-fill me-1"></i> 9891460883
                                &nbsp;|&nbsp;
                                <i class="bi bi-envelope-fill me-1"></i> univprephub@gmail.com
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/auth";
import { usePremiumCoursesStore } from "@/stores/premiumCourses";

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
const store = usePremiumCoursesStore();

const course = ref(null);
const enrolled = ref(false);
const loading = ref(true);

const features = computed(() =>
    course.value?.features?.length
        ? course.value.features
        : [
            'Live Classes',
            'Recorded Sessions',
            'PDF Notes',
            'Mock Tests',
            'MCQs',
            'Doubt Resolution',
            'Lifetime Access',
            '100 Hours Content',
        ]
);

const formatPrice = (value) => {
    return new Intl.NumberFormat('en-IN').format(Number(value) || 0);
};

const openVideo = () => {
    if (course.value?.video_url) window.open(course.value.video_url, "_blank");
};

const viewPdf = () => {
    if (course.value?.pdf_url) window.open(course.value.pdf_url, "_blank");
};

const showQR = () => {
    if (course.value?.qr_code_url) {
        Swal.fire({
            title: 'Scan to Pay',
            imageUrl: course.value.qr_code_url,
            imageWidth: 260,
            imageHeight: 260,
            imageAlt: 'Payment QR Code',
            html: `<p class="mt-2 fw-bold text-danger fs-5">UPI: ${course.value.upi_id || 'Contact Admin'}</p>`,
            confirmButtonText: 'Close'
        });
    } else {
        Swal.fire({
            icon: 'info',
            title: 'Use UPI ID',
            text: course.value?.upi_id || 'Contact admin for payment details'
        });
    }
};

const promptLogin = () => {
    localStorage.setItem("premium_redirect_url", router.currentRoute.value.fullPath);
    router.push("/login");
};

const enrollCourse = async () => {
    try {
        await store.enroll(route.params.id);
        enrolled.value = true;
        Swal.fire({
            icon: "success",
            title: "Enrolled successfully!",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
        });
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Enrollment failed",
            text: error?.response?.data?.message || error.message,
        });
    }
};

const goBack = () => router.push("/premium");

onMounted(async () => {
    loading.value = true;
    try {
        course.value = await store.fetchCourse(route.params.id);
        if (authStore.userData) {
            enrolled.value = await store.checkEnrollment(route.params.id);
        }
    } catch (error) {
        if (error?.response?.status === 404) {
            router.push({ name: "notFound" });
            return;
        }
        Swal.fire({
            icon: "error",
            title: "Unable to load course",
            text: error?.response?.data?.message || error.message,
        });
    } finally {
        loading.value = false;
    }
});
</script>

<style scoped>
.hero-banner {
    width: 100%;
    height: 380px;
    object-fit: cover;
}
.hero-banner-fallback {
    width: 100%;
    height: 380px;
    background: linear-gradient(135deg, #1a1a2e, #16213e);
}
.badge-teal {
    background: #20c997;
    color: #fff;
    border-radius: 8px;
}
.feature-pill {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}
.info-row {
    display: flex;
    align-items: flex-start;
    gap: 4px;
}
.features-mini {
    background: #f8fafc;
    border-radius: 8px;
    padding: 0.75rem 1rem;
}
.payment-card {
    background: #EEF4FF;
    border: 1px solid #B8D4FF;
}
.upi-box {
    background: #fff5f5;
    border: 1px solid #fecaca;
}
.amount-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}
.steps-box {
    background: #fff;
    border: 1px solid #e2e8f0;
}
.step-num {
    min-width: 28px;
    height: 28px;
    background: #3b82f6;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
}
.btn {
    transition: all 0.2s ease;
}
.btn:not(:disabled):hover {
    transform: translateY(-2px);
}
.sticky-top {
    position: sticky;
    top: 80px;
}
</style>