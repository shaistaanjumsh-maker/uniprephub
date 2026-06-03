<template>
    <!-- About 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5">
        <div class="container">
            <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                <div class="col-12 col-lg-6 col-xl-5">
                    <img
                        class="img-fluid rounded"
                        loading="lazy"
                        src="/public/assets/website/teacher.jpg"
                        alt="About 1"
                    />
                </div>
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="row justify-content-xl-center">
                        <div class="col-12 col-xl-11">
                            <h2 class="mb-3 fw-bold">{{ $t('Why Choose') }} <span class="text-primary fs-1">{{ masterStore?.masterData?.name }}</span>?</h2>
                            <p class="lead fs-4 text-secondary mb-3">
                                {{ $t('We help students crack JMI, AMU, JNU and CUET entrance exams with free notes, mock tests, solved papers and expert guidance') }}.
                            </p>
                            <p class="mb-5">
                                {{ $t('UnivPrepHub is a fast-growing education platform focused on university entrance exam preparation. We believe every student deserves quality study material regardless of their background or resources. Our goal is to empower students with the tools and confidence they need to achieve their academic goals') }}.
                            </p>
                            <div class="row gy-4 gy-md-0 gx-xxl-5X">
                                <div class="col-12 col-md-6">
                                    <div class="d-flex p-3 rounded-3 hover-highlight shadow-sm">
                                        <div class="me-4 text-primary">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                fill="#C0C0C0"
                                                class="bi bi-gear-fill"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"
                                                />
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="h4 mb-3">
                                                {{ $t('Trusted Platform') }}
                                            </h2>
                                            <p class="text-secondary mb-0">
                                                {{ $t('Thousands of students trust UnivPrepHub for JMI, AMU and CUET exam preparation') }}.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex p-3 rounded-3 hover-highlight shadow-sm">
                                        <div class="me-4 text-primary">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                fill="#FFC107"
                                                class="bi bi-fire"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z"
                                                />
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="h4 mb-3">
                                                {{ $t('Free & Premium Content') }}
                                            </h2>
                                            <p class="text-secondary mb-0">
                                                {{ $t('Access free notes, solved papers and mock tests — or upgrade for premium study packages') }}.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row gy-5 align-items-center">
                <!-- Left Content -->
                <div class="col-12 col-lg-6">
                    <h2 class="fw-bold mb-3 fs-1">{{ $t('Our Mission') }}</h2>
                    <p class="lead text-muted mb-4">
                        {{ $t('We are Educators. Our mission is to make quality education accessible to everyone, regardless of background or resources. Through UnivPrepHub, we aim to empower students with the tools and confidence they need to achieve their academic goals') }}.
                    </p>

                    <!-- Highlights -->
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-3 d-flex flex-row align-items-center">
                                <i class="bi bi-lightning-charge-fill text-primary fs-2 me-3"></i>
                                <p class="fs-6 fw-semibold mb-0">
                                    {{ $t('Free study material for every student') }}.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-3 d-flex flex-row align-items-center">
                                <i class="bi bi-award-fill text-success fs-2 me-3"></i>
                                <p class="fs-6 fw-semibold mb-0">
                                    {{ $t('Solved papers and mock tests for JMI, AMU, CUET') }}.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-3 d-flex flex-row align-items-center">
                                <i class="bi bi-people-fill text-warning fs-2 me-3"></i>
                                <p class="fs-6 fw-semibold mb-0">
                                    {{ $t('Trusted by thousands of university aspirants') }}.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-3 d-flex flex-row align-items-center">
                                <i class="bi bi-bar-chart-fill text-danger fs-2 me-3"></i>
                                <p class="fs-6 fw-semibold mb-0">
                                    {{ $t('Proven results in Jamia and AMU entrance exams') }}.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="mt-4">
                        <router-link
                            to="/contact-us"
                            class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm"
                        >
                            <i class="bi bi-chat-dots-fill me-2"></i> {{ $t('Connect Now') }}
                        </router-link>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="col-12 col-lg-6 text-center">
                    <img
                        class="img-fluid rounded shadow"
                        loading="lazy"
                        src="/public/assets/website/about2.jpg"
                        alt="About 2"
                    />
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-dark">
        <div class="container">
            <!-- Highlight Stats -->
            <div class="row g-4 text-center mb-5">
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 hover-highlight">
                        <i class="bi bi-people-fill fs-1 text-primary mb-2"></i>
                        <h3 class="fw-bold mb-1">{{ masterStore.masterData.total_student }}+</h3>
                        <p class="text-muted mb-0">{{ $t('Active Students') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 hover-highlight">
                        <i class="bi bi-journal-bookmark-fill fs-1 text-success mb-2"></i>
                        <h3 class="fw-bold mb-1">{{ masterStore.masterData.total_courses }}+</h3>
                        <p class="text-muted mb-0">{{ $t('Study Packages') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 hover-highlight">
                        <i class="bi bi-mortarboard-fill fs-1 text-warning mb-2"></i>
                        <h3 class="fw-bold mb-1">{{ masterStore.masterData.total_instructors }}+</h3>
                        <p class="text-muted mb-0">{{ $t('Expert Mentors') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 hover-highlight">
                        <i class="bi bi-award-fill fs-1 text-warning mb-2"></i>
                        <h3 class="fw-bold mb-1">{{ masterStore.masterData.total_enrollments }}+</h3>
                        <p class="text-muted mb-0">{{ $t('Enrolled Students') }}</p>
                    </div>
                </div>
            </div>

            <!-- Heading -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="fw-bold display-5 text-dark">{{ $t('What We Offer') }}</h2>
                    <p class="text-muted lead">
                        {{ $t('Everything you need to crack JMI, AMU, JNU and CUET entrance exams — notes, mock tests, solved papers and expert guidance.') }}
                    </p>
                    <hr class="w-25 mx-auto border-3 border-primary" />
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-primary fs-1 mb-3">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('Study Notes') }}</h5>
                        <p class="text-muted">{{ $t('Free and premium notes for JMI, AMU and CUET entrance exams — topic-wise and subject-wise.') }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-success fs-1 mb-3">
                            <i class="bi bi-clipboard2-check-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('Mock Tests') }}</h5>
                        <p class="text-muted">{{ $t('Practice with mock tests and get detailed score breakdown — know your strengths and weak areas.') }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-warning fs-1 mb-3">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('Solved Question Papers') }}</h5>
                        <p class="text-muted">{{ $t('Previous year solved entrance papers for Jamia BA Hons, AMU BBA, BCOM and more.') }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-danger fs-1 mb-3">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('Exam Guidance') }}</h5>
                        <p class="text-muted">{{ $t('Complete syllabus, eligibility, exam pattern and best strategy for JMI, AMU and CUET.') }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-info fs-1 mb-3">
                            <i class="bi bi-play-circle-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('YouTube Video Lectures') }}</h5>
                        <p class="text-muted">{{ $t('Watch free video lectures and exam tips on our YouTube channel — learn anytime, anywhere.') }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 text-center p-4 hover-highlight">
                        <div class="text-purple fs-1 mb-3">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="fw-bold">{{ $t('Premium Packages') }}</h5>
                        <p class="text-muted">{{ $t('Enroll in premium study packages for AMU BBA, BCOM and JMI with exclusive content.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Connect Section -->
            <div class="row justify-content-center text-center mt-5">
                <div class="col-lg-8">
                    <h4 class="fw-bold mb-3">{{ $t('Connect With Us') }}</h4>
                    <p class="text-muted mb-4">
                        {{ $t('Follow us on YouTube and Instagram for latest updates, notices and free lectures') }}.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="https://www.youtube.com/@univprephub8288" target="_blank" rel="noopener noreferrer" class="btn btn-danger btn-lg px-4 rounded-pill shadow-sm">
                            <i class="bi bi-youtube me-2"></i> {{ $t('YouTube Channel') }}
                        </a>

                        <a href="https://www.instagram.com/univprephub/" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-lg px-4 rounded-pill shadow-sm">
                            <i class="bi bi-instagram me-2"></i> {{ $t('Instagram') }}
                        </a>

                        <a href="tel:+919891460883" class="btn btn-outline-primary btn-lg px-4 rounded-pill shadow-sm">
                            <i class="bi bi-telephone-fill me-2"></i> +91 98914 60883
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" v-if="masterStore.masterData?.google_map && masterStore.masterData?.google_map != ''">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">{{ $t('Find Us on Google Maps') }}</h2>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="ratio ratio-16x9 shadow rounded">
                        <div v-html="masterStore.masterData?.google_map" class="ratio ratio-16x9"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>
    .bg-gradient {
        background: linear-gradient(135deg, #f0f9ff, #e0f7fa, #fdfbfb);
    }
    .hover-highlight {
        transition: 0.3s ease-in-out;
    }
    .hover-highlight:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
    }
    .text-purple {
        color: #6f42c1;
    }
</style>

<script setup>
import {useMasterStore} from "@/stores/master";
const masterStore = useMasterStore();
</script>