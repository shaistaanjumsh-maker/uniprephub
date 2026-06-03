<template>
  <section class="quiz-section">
    <div class="container">
      <div class="quiz-grid">

        <!-- Left: Description -->
        <div class="quiz-left">
          <div class="pill yellow">Live · Interactive</div>
          <h2 class="sec-title">
            Live Quizzes &amp; <span class="text-yellow">Mock Tests!</span>
          </h2>
          <p class="sec-sub">A comprehensive report of your preparation</p>

          <p class="quiz-body">
            Get a clear and complete view of how you did! Our mock test result gives you a detailed
            breakdown of your performance — showing your total score, questions you got right, and
            where you slipped up.
          </p>
          <p class="quiz-body">
            It's crafted to highlight your strengths and gently point out the areas that need a bit
            more focus. With this insight, you're not just preparing — you're preparing smarter.
          </p>

          <!-- Feature Pills -->
          <div class="feat-pills">
            <span v-for="(f, i) in features" :key="i" class="feat-pill">
              <i :class="['fas', f.icon]"></i> {{ f.label }}
            </span>
          </div>

          <!-- CTA -->
          <router-link to="/quiz" class="quiz-cta">
            <i class="fas fa-play-circle me-2"></i> Take a Mock Test Now
          </router-link>
        </div>

        <!-- Right: Scoreboard -->
        <div class="quiz-right">
          <div class="scoreboard">
            <div class="scoreboard-head">
              <span class="trophy">🏆</span>
              <span class="scoreboard-title">Scoreboard</span>
            </div>
            <table class="score-table">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Name</th>
                  <th>Score / 80</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(entry, i) in scoreboard"
                  :key="i"
                  :class="'rank-row rank-' + (i + 1)"
                >
                  <td><span class="rank-badge">{{ i + 1 }}</span></td>
                  <td class="entry-name">{{ entry.name }}</td>
                  <td class="entry-score">{{ entry.score }}</td>
                </tr>
              </tbody>
            </table>
            <router-link to="/quiz/results" class="see-results">
              See Your Result →
            </router-link>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const features = ref([
  { icon: "fa-chart-bar",    label: "Detailed Score Breakdown" },
  { icon: "fa-check-circle", label: "Right & Wrong Analysis"   },
  { icon: "fa-bolt",         label: "Instant Results"           },
  { icon: "fa-rotate-right", label: "Reattempt Anytime"        },
]);

const scoreboard = ref([
  { name: "Zohra Fatima",   score: 66.5  },
  { name: "Mohammed Aatif", score: 66.25 },
  { name: "Kashish Fatima", score: 63    },
]);
</script>

<style scoped>
.quiz-section {
  padding: 80px 0;
  background: linear-gradient(135deg, #0f0f1e 0%, #1a1a3e 60%, #0f172a 100%);
  position: relative;
  overflow: hidden;
}

.quiz-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 20% 50%, rgba(79, 70, 229, 0.12), transparent 60%),
    radial-gradient(ellipse at 80% 20%, rgba(245, 197, 24, 0.07), transparent 50%);
  pointer-events: none;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
  z-index: 1;
}

.quiz-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}

/* Pill */
.pill {
  display: inline-block;
  font-weight: 700;
  font-size: 0.72rem;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 5px 16px;
  border-radius: 50px;
  margin-bottom: 12px;
}
.pill.yellow {
  background: rgba(245, 197, 24, 0.15);
  color: #f5c518;
  border: 1px solid rgba(245, 197, 24, 0.3);
}

.sec-title { font-size: 2rem; font-weight: 900; color: #fff; line-height: 1.2; margin: 0 0 6px; }
.text-yellow { color: #f5c518; }
.sec-sub  { color: #94a3b8; font-size: 0.88rem; margin-bottom: 20px; }

.quiz-body {
  color: #cbd5e1;
  font-size: 0.94rem;
  line-height: 1.8;
  margin-bottom: 14px;
}

/* Feature Pills */
.feat-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 20px 0;
}

.feat-pill {
  display: flex;
  align-items: center;
  gap: 7px;
  background: rgba(255, 255, 255, 0.07);
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: #e2e8f0;
  font-size: 0.78rem;
  padding: 7px 14px;
  border-radius: 50px;
}

/* CTA */
.quiz-cta {
  display: inline-flex;
  align-items: center;
  padding: 13px 28px;
  background: #f5c518;
  color: #0f172a;
  font-weight: 800;
  font-size: 0.9rem;
  border-radius: 12px;
  text-decoration: none;
  box-shadow: 0 6px 24px rgba(245, 197, 24, 0.35);
  transition: all 0.25s;
}
.quiz-cta:hover { background: #e6b800; transform: translateY(-2px); color: #0f172a; }

/* Scoreboard */
.scoreboard {
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  overflow: hidden;
  backdrop-filter: blur(12px);
}

.scoreboard-head {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 18px 22px;
  background: rgba(245, 197, 24, 0.1);
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.trophy { font-size: 1.4rem; }

.scoreboard-title {
  font-weight: 800;
  color: #f5c518;
  font-size: 1rem;
  letter-spacing: 0.5px;
}

/* Table */
.score-table {
  width: 100%;
  border-collapse: collapse;
}

.score-table thead tr {
  background: rgba(255, 255, 255, 0.04);
}

.score-table th {
  padding: 10px 18px;
  font-size: 0.68rem;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  font-weight: 700;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

.score-table td {
  padding: 14px 18px;
  font-size: 0.88rem;
  color: #e2e8f0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.rank-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  font-weight: 800;
  font-size: 0.8rem;
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.rank-1 .rank-badge { background: #f5c518; color: #0f172a; }
.rank-2 .rank-badge { background: #94a3b8; color: #fff; }
.rank-3 .rank-badge { background: #cd7c4e; color: #fff; }

.entry-name  { font-weight: 600; }
.entry-score { font-weight: 800; color: #f5c518; }

.see-results {
  display: block;
  text-align: center;
  padding: 14px;
  color: #f5c518;
  font-weight: 700;
  font-size: 0.88rem;
  text-decoration: none;
  border-top: 1px solid rgba(255, 255, 255, 0.07);
  transition: background 0.2s;
}
.see-results:hover { background: rgba(245, 197, 24, 0.08); color: #f5c518; }

/* Responsive */
@media (max-width: 768px) {
  .quiz-grid { grid-template-columns: 1fr; gap: 40px; }
  .sec-title { font-size: 1.6rem; }
}
</style>