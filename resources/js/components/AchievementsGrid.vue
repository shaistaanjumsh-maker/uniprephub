<template>
  <section class="achievements-section">
    <div class="container">

      <!-- Header -->
      <div class="section-header">
        <div class="pill indigo">🎓 Success Stories</div>
        <h2 class="sec-title">
          Our <span class="text-indigo">Top Rated</span> Students
        </h2>
        <p class="sec-sub">Congratulations to all our achievers!</p>
      </div>

      <!-- Cards Grid -->
      <div class="achievers-grid">
        <div v-for="(s, i) in students" :key="i" class="achiever-card">
          <p class="card-university">{{ s.university }}</p>
          <div class="card-avatar">{{ s.name.charAt(0) }}</div>
          <div class="card-medal">🏅</div>
          <p class="card-degree">{{ s.degree }}</p>
          <h6 class="card-name">{{ s.name }}</h6>
          <div class="card-congrats">CONGRATULATION</div>
          <p class="card-contact">Contact: {{ s.contact }}</p>
        </div>
      </div>

      <!-- View All Button -->
      <div class="view-all-wrap">
        <router-link to="/achievements" class="view-all-btn">
          View All Achievers <i class="fas fa-arrow-right ms-2"></i>
        </router-link>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const students = ref([
  { name: "Mariam Parwej",  degree: "BA(HONS)",           university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Priyanghi",      degree: "BSW",                 university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Rais",           degree: "BA(HONS) History",    university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Muneer",         degree: "BA(HONS) History",    university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Znooran Javad",  degree: "BA(HONS) History",    university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Saliq Ahmed M.", degree: "BA(HONS) History",    university: "Jamia Millia Islamia",  contact: "9891460883" },
  { name: "Mohd Adil Baig", degree: "B.A. Hons. (Arts)",   university: "Aligarh Muslim Univ.",  contact: "8851474902" },
  { name: "Ali Tariq",      degree: "B.Com Hons.",          university: "Aligarh Muslim Univ.",  contact: "8851474902" },
  { name: "Mohd Asim",      degree: "B.Hons. Arts",         university: "Aligarh Muslim Univ.",  contact: "8851474902" },
  { name: "Prince",         degree: "B.Hons. Geography",    university: "Jamia Millia Islamia",  contact: "8851474902" },
  { name: "Samara Illarie", degree: "B.Hons. Geography",    university: "Jamia Millia Islamia",  contact: "8851474902" },
  { name: "Mohd Rial",      degree: "B.Hons. Geography",    university: "Jamia Millia Islamia",  contact: "8851474902" },
]);
</script>

<style scoped>
.achievements-section {
  padding: 100px 0 60px;
  background: linear-gradient(180deg, #f7f9ff 0%, #eef4ff 100%);
  position: relative;
  overflow: hidden;
}

.achievements-section::before {
  content: '';
  position: absolute;
  top: -40px;
  right: -40px;
  width: 220px;
  height: 220px;
  border-radius: 50%;
  background: rgba(79, 70, 229, 0.12);
}

.achievements-section::after {
  content: '';
  position: absolute;
  bottom: -30px;
  left: -20px;
  width: 260px;
  height: 260px;
  border-radius: 50%;
  background: rgba(59, 130, 246, 0.1);
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
  background: rgba(79, 70, 229, 0.12);
  color: #4338ca;
}
.pill.indigo { background: rgba(79, 70, 229, 0.14); color: #4338ca; }

.sec-title {
  font-size: clamp(2.1rem, 2.8vw, 3rem);
  font-weight: 900;
  color: #0f172a;
  margin: 0;
  line-height: 1.1;
}

.text-indigo { color: #4f46e5; }

.sec-sub {
  color: #64748b;
  font-size: 0.95rem;
  margin-top: 0.85rem;
  max-width: 640px;
  margin-left: auto;
  margin-right: auto;
  line-height: 1.8;
}

/* Grid */
.achievers-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 24px;
}

/* Card */
.achiever-card {
  position: relative;
  background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
  border-radius: 28px;
  padding: 28px 20px 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  border: 1px solid rgba(79, 70, 229, 0.12);
  box-shadow: 0 24px 50px rgba(15, 23, 42, 0.06);
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}
.achiever-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 30px 70px rgba(15, 23, 42, 0.12);
  border-color: rgba(79, 70, 229, 0.18);
}

.achiever-card::before {
  content: '';
  position: absolute;
  top: 16px;
  right: 16px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(79, 70, 229, 0.18);
}

.card-university {
  font-size: 0.68rem;
  font-weight: 700;
  color: #4f46e5;
  text-transform: uppercase;
  letter-spacing: 0.45px;
  margin: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}

.card-avatar {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4f46e5, #818cf8);
  color: #fff;
  font-weight: 900;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 4px solid rgba(79, 70, 229, 0.16);
  margin-top: 4px;
}

.card-medal {
  font-size: 1.2rem;
  margin-top: -4px;
}

.card-degree {
  font-size: 0.78rem;
  font-weight: 700;
  color: #334155;
  margin: 0;
}

.card-name {
  font-size: 0.95rem;
  font-weight: 800;
  color: #111827;
  margin: 0;
}

.card-congrats {
  background: linear-gradient(135deg, #6366f1, #22c55e);
  color: #fff;
  font-size: 0.65rem;
  font-weight: 800;
  letter-spacing: 1px;
  padding: 5px 14px;
  border-radius: 999px;
}

.card-contact {
  font-size: 0.72rem;
  color: #64748b;
  margin: 0;
}

/* View All */
.view-all-wrap {
  text-align: center;
  margin-top: 56px;
}

.view-all-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 32px;
  background: linear-gradient(135deg, #4f46e5, #2563eb);
  color: #fff;
  font-weight: 700;
  font-size: 0.95rem;
  border-radius: 999px;
  text-decoration: none;
  box-shadow: 0 14px 40px rgba(79, 70, 229, 0.2);
  transition: transform 0.25s ease, box-shadow 0.25s ease, opacity 0.25s ease;
}
.view-all-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 18px 50px rgba(79, 70, 229, 0.24);
  opacity: 0.98;
}

/* Responsive */
@media (max-width: 992px) {
  .achievers-grid { gap: 18px; }
}

@media (max-width: 768px) {
  .achievers-grid { grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); }
  .sec-title { font-size: 1.9rem; }
}

@media (max-width: 576px) {
  .achievements-section { padding: 80px 0 40px; }
  .pill { padding: 5px 14px; }
  .view-all-btn { width: 100%; }
}
</style>