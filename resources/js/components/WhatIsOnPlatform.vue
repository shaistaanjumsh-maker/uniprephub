<template>
  <section class="platform-section">
    <div class="container">

      <!-- Header -->
      <div class="section-header">
        <div class="pill green">Platform Features</div>
        <h2 class="sec-title">
          What is on <span class="text-green">UnivPrepHub</span>
        </h2>
        <p class="sec-sub">And why should you visit it daily</p>
      </div>

      <div class="platform-grid">

        <!-- Left: Feature List -->
        <div class="features-list">
          <div
            v-for="(feat, i) in features"
            :key="i"
            class="feat-row"
            :class="{ 'feat-row--active': activeIndex === i }"
            @mouseenter="activeIndex = i"
            @mouseleave="activeIndex = -1"
          >
            <div class="feat-icon" :style="{ background: feat.bg }">
              <i :class="feat.icon" :style="{ color: feat.color }"></i>
            </div>
            <div class="feat-text">
              <h6 class="feat-title">{{ feat.title }}</h6>
              <p class="feat-desc">{{ feat.desc }}</p>
            </div>
            <i class="bi bi-chevron-right feat-arrow"></i>
          </div>
        </div>

        <!-- Right: Live Class Card -->
        <div class="live-card">
          <div class="live-card__top">
            <div class="live-badge">
              <span class="live-dot"></span> LIVE
            </div>
          </div>
          <div class="live-card__body">
            <span class="live-tag">Marathon Class</span>
            <h3 class="live-title">JMI, AMU<br>BA HONS.</h3>
            <p class="live-subjects">GK/GS, POLITICS &amp; CURRENT AFFAIRS</p>
            <p class="live-courses">B.A. Hons., BBA, B.Com, B.A. LLB, B.Sc, B.Ed</p>
          </div>
          <a href="https://www.youtube.com/@UnivPrepHub" target="_blank" class="live-subscribe-btn">
            <i class="fab fa-youtube me-2"></i>
            Subscribe to our YouTube Channel
          </a>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const activeIndex = ref(-1);

const features = ref([
  { icon: "bi bi-newspaper",      title: "Daily Current Affairs", desc: "Stay updated with the latest news and events.",           bg: "#eff6ff", color: "#2563eb" },
  { icon: "bi bi-question-circle",title: "Jamia Quizzes",         desc: "Practice quizzes designed for Jamia exams.",              bg: "#fef3c7", color: "#d97706" },
  { icon: "bi bi-book-open",      title: "Study Material",        desc: "Well-structured content for various courses.",            bg: "#ecfdf5", color: "#059669" },
  { icon: "bi bi-pencil-square",  title: "CUET Quizzes",          desc: "Practice key topics for the CUET General Test.",          bg: "#fdf2f8", color: "#9d174d" },
  { icon: "bi bi-download",       title: "Free Resources",        desc: "Access free PDFs, videos, and more.",                     bg: "#eef2ff", color: "#4f46e5" },
]);
</script>

<style scoped>
.platform-section {
  position: relative;
  padding: 100px 0;
  background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
  overflow: hidden;
}

.platform-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: -40px;
  width: 260px;
  height: 260px;
  border-radius: 50%;
  background: rgba(59, 130, 246, 0.12);
}

.container {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
  z-index: 1;
}

/* Header */
.section-header {
  text-align: center;
  margin-bottom: 3rem;
}

.pill {
  display: inline-block;
  font-weight: 700;
  font-size: 0.75rem;
  letter-spacing: 1.4px;
  text-transform: uppercase;
  padding: 6px 18px;
  border-radius: 999px;
  margin-bottom: 14px;
}
.pill.green { background: rgba(16, 185, 129, 0.12); color: #059669; }

.sec-title {
  font-size: clamp(2.4rem, 4vw, 3.2rem);
  font-weight: 900;
  color: #0f172a;
  line-height: 1.08;
  margin: 0;
}
.text-green { color: #059669; }

.sec-sub {
  color: #64748b;
  font-size: 0.98rem;
  margin-top: 0.85rem;
}

/* Grid */
.platform-grid {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 42px;
  align-items: center;
}

/* Feature Rows */
.features-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.feat-row {
  display: flex;
  align-items: center;
  gap: 18px;
  padding: 18px 22px;
  background: #ffffff;
  border: 1.5px solid rgba(148, 163, 184, 0.16);
  border-radius: 20px;
  cursor: default;
  transition: all 0.25s ease;
}

.feat-row--active,
.feat-row:hover {
  border-color: rgba(79, 70, 229, 0.3);
  box-shadow: 0 18px 40px rgba(79, 70, 229, 0.1);
  transform: translateX(3px);
}

.feat-icon {
  width: 52px;
  height: 52px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  flex-shrink: 0;
}

.feat-title {
  font-weight: 800;
  font-size: 0.98rem;
  color: #0f172a;
  margin: 0 0 4px;
}

.feat-desc {
  font-size: 0.92rem;
  color: #64748b;
  margin: 0;
}

.feat-arrow {
  color: #cbd5e1;
  font-size: 0.78rem;
  transition: color 0.25s;
}
.feat-row--active .feat-arrow,
.feat-row:hover .feat-arrow { color: #4f46e5; }

/* Live Card */
.live-card {
  border-radius: 32px;
  overflow: hidden;
  box-shadow: 0 30px 80px rgba(15, 23, 42, 0.16);
  background: linear-gradient(180deg, #111827 0%, #0f172a 100%);
}

.live-card__top {
  padding: 18px 18px 0;
  display: flex;
  justify-content: flex-end;
}

.live-badge {
  background: #ef4444;
  color: #fff;
  padding: 5px 14px;
  border-radius: 999px;
  font-weight: 800;
  font-size: 0.75rem;
  letter-spacing: 1px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.live-dot {
  width: 8px;
  height: 8px;
  background: #fff;
  border-radius: 50%;
  animation: pulse 1.2s infinite;
}

.live-card__body {
  padding: 26px 30px 28px;
}

.live-tag {
  display: inline-block;
  background: rgba(245, 197, 24, 0.12);
  color: #f5c518;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 6px 13px;
  border-radius: 999px;
  border: 1px solid rgba(245, 197, 24, 0.25);
  margin-bottom: 14px;
}

.live-title {
  color: #fff;
  font-size: clamp(2rem, 4vw, 2.4rem);
  font-weight: 900;
  line-height: 1.1;
  margin: 0 0 10px;
}

.live-subjects {
  color: #f5c518;
  font-weight: 700;
  font-size: 0.9rem;
  margin: 0 0 10px;
}

.live-courses {
  color: #cbd5e1;
  font-size: 0.85rem;
  margin: 0;
}

.live-subscribe-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 16px 18px;
  background: #ef4444;
  color: #fff;
  font-weight: 800;
  font-size: 0.95rem;
  text-decoration: none;
  transition: background 0.2s ease;
}
.live-subscribe-btn:hover { background: #c81c1c; }

/* Responsive */
@media (max-width: 992px) {
  .platform-grid { grid-template-columns: 1fr; }
  .sec-title { font-size: 2.2rem; }
}

@media (max-width: 768px) {
  .platform-section { padding: 70px 0; }
  .feat-row { padding: 16px 18px; }
  .live-card__body { padding: 22px 20px 24px; }
  .live-title { font-size: 1.9rem; }
}
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.2;} }
</style>