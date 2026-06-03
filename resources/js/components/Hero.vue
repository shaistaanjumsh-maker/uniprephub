<template>
    <section class="pb-3 pb-lg-0 mb-5 position-relative mt-0">
        <section class="hero">
            <div class="container">
                <div class="row p-3 p-lg-5">
                    <div class="col-lg-7 col-xxl-8 text-center text-lg-start my-auto pb-5 mb-lg-auto">
                        <span class="bg-white px-3 py-2 text-primary fw-bold rounded-pill">
                            {{ masterStore?.masterData?.hero_subtitle ?? $t('Hi Learners') }}
                        </span>
                        <h2 class="fw-bold my-3 my-md-4 hero-title">
                            {{ masterStore?.masterData?.hero_title ?? $t('Education for Everyone') }}
                        </h2>
                        <span class="d-block mb-4 mx-auto mx-lg-0 hero-subtitle">
                            {{ masterStore?.masterData?.hero_description ?? $t('Our mission is to make quality education accessible to everyone, regardless of background or resources. Through Univ Prep Hub, we aim to empower students with the tools and confidence they need to achieve their academic goals') }}.
                        </span>

                        <!-- Course Selection Cards -->
                        <div class="course-options d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start mb-4">
                            <!-- Free Course Card -->
                            <div class="course-card" @click="goToCourses('free')">
                                <span class="course-tag tag-free">{{ $t('Free') }}</span>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                    <span class="course-university">{{ $t('Jamia Millia Islamia') }}</span>
                                </div>
                                <span class="course-label">{{ $t('Select your course') }}</span>
                            </div>

                            <!-- Premium Course Card -->
                            <div class="course-card" @click="goToCourses('premium')">
                                <span class="course-tag tag-paid">{{ $t('Paid') }}</span>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                    <span class="course-university">{{ $t('Premium') }}</span>
                                </div>
                                <span class="course-label">{{ $t('UnivPrepHub Premium') }}</span>
                            </div>
                        </div>

                        <!-- Search Bar -->
                        <div class="mx-auto mx-lg-0 col-12 col-md-8 col-xl-8">
                            <form @submit.prevent="performSearch" class="input-group" role="search">
                                <input
                                    v-model="searchInputQuery"
                                    class="form-control search-input border-0"
                                    type="search"
                                    :placeholder="$t('Search Course')"
                                />
                                <div class="bg-white search-btn-wrapper">
                                    <button type="submit" class="btn btn-primary text-white border-3 border-white py-2">
                                        <i class="ri-search-2-line fs-4"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xxl-4 pt-0 pt-md-0 pb-5">
                        <div class="position-relative d-flex justify-content-center align-items-center">
                            <img
                                :src="masterStore?.masterData?.hero_thumbnail ?? '/assets/website/banner-hero.png'"
                                loading="lazy"
                                class="img-fluid hero-illustration"
                                :alt="$t('Hero Illustration')"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <div class="details-section py-2">
            <div class="container">
                <div class="row text-center">
                    <div class="col-6 col-md-4 mb-3">
                        <div class="stat-box">
                            <i class="bi bi-award icon"></i>
                            <h3 class="number">{{ masterStore?.masterData?.total_courses }}+</h3>
                            <p class="label">{{ $t('Total Premium Courses') }}</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="stat-box">
                            <i class="bi bi-mortarboard icon"></i>
                            <h3 class="number">{{ masterStore?.masterData?.total_enrollments }}+</h3>
                            <p class="label">{{ $t('Total Enrolled Students') }}</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="stat-box">
                            <i class="bi bi-person-video3 icon"></i>
                            <h3 class="number">{{ masterStore?.masterData?.total_instructors }}+</h3>
                               <p class="label">{{ $t('Student Success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
.hero {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.88), rgba(15, 23, 42, 0.4)), url('/assets/website/hero-background.jpg') no-repeat center;
    background-size: cover;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    border-bottom-left-radius: 100px;
    border-bottom-right-radius: 100px;
    padding: 80px 20px;

    .search-input {
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;

        &::placeholder {
            color: #cbd5e1;
        }
    }

    .search-btn-wrapper {
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;

        button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}

.hero-title {
    width: 80%;
    font-size: 64px;
    color: #ffffff;
}

.hero-subtitle {
    width: 70%;
    color: #ffffff;
    font-size: 14px;
}

.hero-illustration {
    position: relative;
    z-index: 1;
    box-sizing: border-box;
}

/* Course Option Cards */
.course-options {
    .course-card {
        position: relative;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 14px;
        padding: 14px 20px 12px;
        cursor: pointer;
        min-width: 160px;
        transition: background 0.2s ease, transform 0.2s ease;

        &:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .course-tag {
            position: absolute;
            top: -11px;
            right: 12px;
            font-size: 11px;
            font-weight: 700;
            border-radius: 30px;
            padding: 2px 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .tag-free {
            background: #f5a623;
            color: #4a2800;
        }

        .tag-paid {
            background: #5ddd8b;
            color: #003320;
        }

        .course-university {
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 600;
        }

        .course-label {
            color: rgba(255, 255, 255, 0.65);
            font-size: 12px;
            display: block;
            margin-left: 24px;
        }
    }
}

/* Stats Section */
.details-section {
    position: relative;
    margin-top: -60px;
    margin-bottom: 40px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 4px 30px rgba(95, 45, 237, 0.08);
    padding: 40px 20px;
    z-index: 2;
}

.stat-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    .icon {
        font-size: 30px;
        color: var(--bs-primary);
    }

    .number {
        font-size: 22px;
        font-weight: bold;
        margin: 0;
        color: #000;
    }

    .label {
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        margin: 0;
        color: #555;
    }
}

/* Responsive */
@media (max-width: 1600px) {
    .hero { width: 95%; }
}

@media (max-width: 1024px) {
    .hero {
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-bottom-left-radius: 60px;
        border-bottom-right-radius: 60px;
    }
    .hero-subtitle { width: 80%; }
}

@media (max-width: 992px) {
    .hero { padding-top: 80px; }
}

@media (max-width: 768px) {
    .hero {
        padding-top: 60px;
        border-radius: 0px;
    }
    .details-section {
        border-radius: 12px;
        margin-top: -40px;
        padding: 30px 15px;
    }
    .hero-title { font-size: 36px; }
    .hero-subtitle { width: 100%; font-size: 14px; }

    .course-options .course-card {
        min-width: 140px;
    }
}

@media (max-width: 576px) {
    .hero { padding-top: 40px; }
}
</style>

<script setup>
import { useRouter } from "vue-router";
import { ref } from "vue";
import { useMasterStore } from "@/stores/master";

const searchInputQuery = ref("");
const router = useRouter();
const masterStore = useMasterStore();

const performSearch = () => {
    if (searchInputQuery.value) {
        router.push(`/courses?search=${searchInputQuery.value}`);
    }
};

const goToCourses = (type) => {
    router.push(`/courses?type=${type}`);
};
</script>