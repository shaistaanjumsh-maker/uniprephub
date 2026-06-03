<template>
  <section class="about-section py-5">
    <div class="container">
      <div class="row align-items-center gy-4">
        <div class="col-lg-6">
          <span class="section-label">About UnivPrep</span>
          <h2 class="section-title">Built for learners who want to succeed</h2>
          <p class="section-copy">
            UnivPrep brings together expert instructors, practice tests, and curated courses so every student can prepare with confidence.
          </p>
          <div class="stats-grid mt-4">
            <div class="stat-card">
              <strong>100+</strong>
              <span>Courses</span>
            </div>
            <div class="stat-card">
              <strong>20k+</strong>
              <span>Students</span>
            </div>
            <div class="stat-card">
              <strong>500+</strong>
              <span>Tests</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-visual">
            <img :src="'/assets/website/banner-hero.png'" alt="About UnivPrep" loading="lazy" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about-section {
  position: relative;
  padding: 100px 0;
  background: linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%);
  overflow: hidden;
}

.about-section::before {
  content: '';
  position: absolute;
  top: -40px;
  right: 5%;
  width: 220px;
  height: 220px;
  border-radius: 50%;
  background: rgba(79, 70, 229, 0.08);
}

.section-label {
  display: inline-block;
  margin-bottom: 1rem;
  color: #4338ca;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.16em;
  font-size: 0.8rem;
}

.section-title {
  font-size: clamp(2.4rem, 4vw, 3.4rem);
  font-weight: 900;
  line-height: 1.05;
  margin: 0;
  max-width: 720px;
}

.section-copy {
  font-size: 1rem;
  color: #475569;
  max-width: 640px;
  margin-top: 1.2rem;
  line-height: 1.8;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 1rem;
  margin-top: 2rem;
}

.stat-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.1);
  border-radius: 24px;
  padding: 1.2rem 1.4rem;
  text-align: center;
  box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 24px 60px rgba(15, 23, 42, 0.1);
}

.stat-card strong {
  display: block;
  font-size: 1.75rem;
  color: #111827;
}

.stat-card span {
  display: block;
  color: #64748b;
  margin-top: 0.4rem;
  font-weight: 600;
}

.about-visual img {
  width: 100%;
  border-radius: 32px;
  object-fit: cover;
  box-shadow: 0 30px 80px rgba(15, 23, 42, 0.08);
}

@media (max-width: 992px) {
  .about-section {
    padding: 70px 0;
  }
}
</style>
