<template>
  <section class="testimonials-section py-5">
    <div class="container">
      <div class="section-header text-center mb-4">
        <span class="section-label">What students say</span>
        <h2 class="section-title">Trusted by thousands of learners</h2>
      </div>
      <Testimonials />
    </div>
  </section>
</template>

<script setup>
import Testimonials from "./Testimonials.vue";
</script>

<style scoped>
.testimonials-section {
  padding: 100px 0;
  background: linear-gradient(180deg, #eef5ff 0%, #ffffff 100%);
}

.section-label {
  display: inline-flex;
  margin-bottom: 0.9rem;
  color: #2563eb;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 0.8rem;
  letter-spacing: 0.14em;
  background: rgba(37, 99, 235, 0.1);
  padding: 8px 14px;
  border-radius: 999px;
}

.section-title {
  font-size: clamp(2.1rem, 4vw, 3rem);
  font-weight: 900;
  color: #0f172a;
  margin: 0;
  line-height: 1.05;
}
</style>
