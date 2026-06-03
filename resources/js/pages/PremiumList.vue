<template>
    <section class="py-5" style="background: #F8FAFC;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-column flex-md-row gap-3">
                <div>
                    <h1 class="fw-bold">{{ $t('Premium Courses') }}</h1>
                    <p class="text-muted mb-0">{{ $t('Browse lifetime access premium courses for every subject.') }}</p>
                </div>
            </div>

            <div v-if="store.loading" class="text-center my-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <div v-if="!store.loading && store.courses.length === 0" class="text-center py-5">
                <h4 class="text-muted">{{ $t('No premium courses available') }}</h4>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <div v-for="course in store.courses" :key="course.id" class="col">
                    <div class="card h-100 border-0 shadow-sm premium-card">
                        <div class="card-body d-flex flex-column">
                            <div class="premium-card-media mb-3">
                                <template v-if="course.thumbnail_url">
                                    <img :src="course.thumbnail_url" class="img-fluid rounded-3 w-100 premium-thumb" alt="Course Thumbnail" />
                                </template>
                                <template v-else>
                                    <div class="pdf-fallback rounded-3 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-1"></i>
                                    </div>
                                </template>
                            </div>
                            <span class="badge badge-teal mb-3">{{ course.subject_name }}</span>
                            <h5 class="fw-bold mb-2 line-clamp-2">{{ course.topic_name }}</h5>
                            <p class="text-muted mb-3 description-clamp">{{ truncate(course.description, 120) }}</p>
                            <div class="mb-3">
                                <span class="d-block fs-4 fw-bold text-success">₹ {{ formatPrice(course.price) }}/-</span>
                            </div>
                            <button @click="handleEnroll(course.id)"
                                class="btn btn-success mt-auto w-100 rounded-pill">
                                {{ $t('Enroll Now') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { usePremiumCoursesStore } from "@/stores/premiumCourses";

const router = useRouter();
const authStore = useAuthStore();
const store = usePremiumCoursesStore();

const truncate = (text, length) => {
    if (!text) return "";
    return text.length > length ? text.slice(0, length) + "..." : text;
};

const formatPrice = (value) => {
    return new Intl.NumberFormat('en-IN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(Number(value) || 0);
};

const handleEnroll = (courseId) => {
    if (!authStore.userData) {
        localStorage.setItem("premium_redirect_url", `/premium/enroll/${courseId}`);
        router.push("/login");
        return;
    }
    router.push(`/premium/enroll/${courseId}`);
};

onMounted(async () => {
    await store.fetchVisibleCourses();
});
</script>

<style scoped>
.premium-card {
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.premium-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 24px 50px rgba(34, 62, 125, 0.16);
}
.premium-card-media {
    height: 200px;
    overflow: hidden;
    border-radius: 1rem 1rem 0 0;
}
.premium-thumb {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.pdf-fallback {
    width: 100%;
    min-height: 200px;
    background: #f2f2f2;
    color: #adb5bd;
}
.pdf-fallback i {
    font-size: 48px;
}
.badge-teal {
    background: #20c997;
    color: #fff;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.description-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
