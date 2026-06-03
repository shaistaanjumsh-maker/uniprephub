<template>
  <section class="about-section">
    <div class="container">
      <div class="about-grid">

        <!-- Left: Text Content -->
        <div class="about-left">
          <div class="about-pill">About Us</div>
          <h2 class="about-heading">
            Empowering Students<br>
            <span class="about-heading--highlight">Across India</span>
          </h2>
          <p class="about-body">
            Our mission is to make quality education accessible to everyone, regardless of
            background or resources. Through Univ Prep Hub, we aim to empower students with
            the tools and confidence they need to achieve their academic goals.
          </p>

          <!-- Stats -->
          <div class="about-stats">
            <div v-for="(s, i) in stats" :key="i" class="stat-card">
              <span class="stat-number">{{ s.value }}</span>
              <span class="stat-label">{{ s.label }}</span>
            </div>
          </div>
        </div>

        <!-- Right: Visual Collage -->
        <div class="about-right">
          <div class="collage">
            <div class="collage-main">
              <div class="collage-block block-purple">
                <span class="block-icon">📚</span>
                <small>Study Together</small>
              </div>
            </div>
            <div class="collage-side">
              <div class="collage-block block-teal">
                <span class="block-icon">🎓</span>
                <small>Achieve More</small>
              </div>
              <div class="collage-block block-orange">
                <span class="block-icon">✍️</span>
                <small>Learn Daily</small>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const stats = ref([
  { value: "20+",  label: "Premium Courses"    },
  { value: "100+", label: "Enrolled Students"  },
  { value: "11+",  label: "Top Instructors"    },
]);
</script>

<style scoped>
.about-section {
  padding: 80px 0;
  background: #f8faff;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}

/* ── Left ── */
.about-pill {
  display: inline-block;
  background: #eef2ff;
  color: #4f46e5;
  font-weight: 700;
  font-size: 0.72rem;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 5px 16px;
  border-radius: 50px;
  margin-bottom: 16px;
}

.about-heading {
  font-size: 2.4rem;
  font-weight: 900;
  color: #0f172a;
  line-height: 1.15;
  margin-bottom: 18px;
}

.about-heading--highlight {
  color: #4f46e5;
}

.about-body {
  color: #475569;
  font-size: 0.97rem;
  line-height: 1.8;
  margin-bottom: 32px;
}

.about-stats {
  display: flex;
  gap: 14px;
}

.stat-card {
  flex: 1;
  background: #fff;
  border: 1.5px solid #e2e8f0;
  border-radius: 16px;
  padding: 18px 14px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
  transition: transform 0.25s, box-shadow 0.25s;
}
.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 28px rgba(79, 70, 229, 0.12);
}

.stat-number {
  font-size: 1.7rem;
  font-weight: 900;
  color: #4f46e5;
  line-height: 1;
}

.stat-label {
  font-size: 0.72rem;
  color: #94a3b8;
  margin-top: 4px;
  text-align: center;
}

/* ── Right Collage ── */
.collage {
  display: flex;
  gap: 14px;
  height: 320px;
}

.collage-main {
  flex: 2;
}

.collage-side {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.collage-block {
  width: 100%;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
  border: 2px solid rgba(255, 255, 255, 0.15);
}

.collage-block small {
  font-size: 0.72rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.85);
}

.block-icon {
  font-size: 2.4rem;
}

.block-purple {
  background: linear-gradient(135deg, #4f46e5, #7c3aed);
  flex: 1;
}

.block-teal {
  background: linear-gradient(135deg, #0d9488, #14b8a6);
  flex: 1;
  font-size: 1.8rem;
}

.block-orange {
  background: linear-gradient(135deg, #f59e0b, #f97316);
  font-size: 1.8rem;
}

/* Responsive */
@media (max-width: 768px) {
  .about-grid { grid-template-columns: 1fr; gap: 36px; }
  .about-heading { font-size: 1.8rem; }
  .collage { height: 220px; }
}
</style>