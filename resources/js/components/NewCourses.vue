<template>
  <section class="new-courses-section py-5">
    <div class="container">
      <div class="section-header d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
        <div>
          <span class="section-label">New Courses</span>
          <h2 class="section-title">Explore the latest content</h2>
        </div>
        <router-link to="/courses" class="view-all link-primary">View all courses</router-link>
      </div>

      <div class="row gx-4 gy-4 mt-4">
        <div class="col-md-4" v-for="course in courses" :key="course.id">
          <div class="course-card p-4 h-100">
            <div class="course-badge">{{ course.level }}</div>
            <h5 class="course-title">{{ course.title }}</h5>
            <p class="course-description">{{ course.description }}</p>
            <div class="course-meta mt-3 d-flex justify-content-between align-items-center">
              <span class="price">{{ course.price }}</span>
              <router-link :to="course.link" class="btn btn-outline-primary btn-sm">Enroll</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const courses = [
  { id: 1, title: 'JEE Advanced Complete Crash Course', level: 'Advanced', description: 'A focused course for serious aspirants.', price: 'Free', link: '/courses' },
  { id: 2, title: 'NEET Mock Test Series', level: 'Expert', description: 'Practice with real exam-style questions.', price: '₹199', link: '/courses' },
  { id: 3, title: 'Foundation Mathematics', level: 'Beginner', description: 'Build strong fundamentals for exam success.', price: '₹99', link: '/courses' },
];
</script>

<style scoped>
.new-courses-section {
  background: #ffffff;
}
.section-header {
  gap: 1rem;
}
.section-label {
  display: inline-block;
  font-size: 0.85rem;
  font-weight: 700;
  color: #4f46e5;
  text-transform: uppercase;
}
.section-title {
  font-size: 2rem;
  margin-top: 0.35rem;
  font-weight: 800;
}
.view-all {
  color: #4f46e5;
  text-decoration: none;
}
.course-card {
  background: #f8faff;
  border: 1px solid #e5e7eb;
  border-radius: 1rem;
  min-height: 260px;
}
.course-badge {
  display: inline-flex;
  background: rgba(79, 70, 229, 0.1);
  color: #4f46e5;
  border-radius: 999px;
  padding: 0.35rem 0.85rem;
  font-size: 0.8rem;
  font-weight: 700;
}
.course-title {
  margin-top: 1rem;
  font-size: 1.1rem;
  font-weight: 700;
}
.course-description {
  margin-top: 0.85rem;
  color: #475569;
  line-height: 1.7;
}
.course-meta {
  margin-top: auto;
}
.price {
  color: #111827;
  font-weight: 700;
}
</style>
