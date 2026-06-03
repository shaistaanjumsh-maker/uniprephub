<template>
  <section class="youtube-section">
    <div class="container">

      <!-- Header -->
      <div class="section-header">
        <div class="pill red"><i class="fab fa-youtube me-1"></i> YouTube</div>
        <h2 class="sec-title">Watch Us on <span class="text-red">YouTube</span></h2>
        <p class="sec-sub">High-quality tutorials, exam tips, and study strategies.</p>
      </div>

      <div class="yt-grid">

        <!-- Left: Video Embed -->
        <div class="yt-video-wrap">
          <div class="yt-frame">
            <div class="yt-ratio">
              <iframe
                src="https://www.youtube.com/embed/9V7L-KDQCKI"
                title="UnivPrepHub Marathon"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              ></iframe>
            </div>
          </div>
          <div class="yt-caption">
            <i class="fas fa-circle-play me-2 text-danger"></i>
            Jamia Entrance Exam MCQ | GK/GS | Current Affairs — Marathon 2.0
          </div>
        </div>

        <!-- Right: Info -->
        <div class="yt-info">
          <p class="yt-body">
            Studying doesn't have to be overwhelming. With the right support, every topic becomes easier to understand.
            Our channel offers clear tutorials, smart study tips, and helpful exam strategies to make learning smoother.
          </p>
          <p class="yt-body">
            Whether you're tackling tricky concepts or practicing with mock tests, we've got you covered.
            Dive into our videos, learn at your pace, and move one step closer to your goals. You've got this! 👊
          </p>

          <!-- Stats -->
          <div class="yt-stats">
            <div v-for="(s, i) in stats" :key="i" class="yt-stat">
              <span class="yt-stat-num">{{ s.value }}</span>
              <span class="yt-stat-lbl">{{ s.label }}</span>
            </div>
          </div>

          <!-- CTA -->
          <a href="https://www.youtube.com/@UnivPrepHub" target="_blank" class="yt-subscribe-btn">
            <i class="fab fa-youtube me-2"></i>
            Subscribe to our Channel
          </a>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const stats = ref([
  { value: "500+", label: "Videos"      },
  { value: "50K+", label: "Subscribers" },
  { value: "1M+",  label: "Views"       },
]);
</script>

<style scoped>
.youtube-section {
  padding: 80px 0;
  background: #fff;
  border-top: 1px solid #f1f5f9;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Header */
.section-header {
  text-align: center;
  margin-bottom: 3rem;
}

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
.pill.red { background: #fff1f2; color: #dc2626; }

.sec-title { font-size: 2rem; font-weight: 900; color: #0f172a; margin: 0; line-height: 1.2; }
.text-red  { color: #dc2626; }
.sec-sub   { color: #64748b; font-size: 0.9rem; margin-top: 6px; }

/* Grid */
.yt-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 52px;
  align-items: center;
}

/* Video */
.yt-frame {
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
  background: #000;
}

.yt-ratio {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
}
.yt-ratio iframe {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
}

.yt-caption {
  padding: 11px 16px;
  background: #111;
  color: #9ca3af;
  font-size: 0.78rem;
  display: flex;
  align-items: center;
  border-radius: 0 0 20px 20px;
}

/* Info */
.yt-body {
  color: #475569;
  font-size: 0.95rem;
  line-height: 1.8;
  margin-bottom: 14px;
}

.yt-stats {
  display: flex;
  align-items: center;
  padding: 20px 24px;
  background: #f8faff;
  border-radius: 14px;
  border: 1px solid #e2e8f0;
  margin: 24px 0;
}

.yt-stat {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
}

.yt-stat + .yt-stat::before {
  content: '';
  position: absolute;
  left: 0; top: 50%;
  transform: translateY(-50%);
  width: 1px; height: 36px;
  background: #e2e8f0;
}

.yt-stat-num {
  font-size: 1.5rem;
  font-weight: 900;
  color: #0f172a;
  line-height: 1;
}

.yt-stat-lbl {
  font-size: 0.7rem;
  color: #94a3b8;
  margin-top: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.yt-subscribe-btn {
  display: inline-flex;
  align-items: center;
  padding: 13px 28px;
  background: #ff0000;
  color: #fff;
  font-weight: 700;
  font-size: 0.92rem;
  border-radius: 12px;
  text-decoration: none;
  box-shadow: 0 6px 20px rgba(220, 38, 38, 0.28);
  transition: all 0.25s;
}
.yt-subscribe-btn:hover { background: #b91c1c; transform: translateY(-2px); color: #fff; }

/* Responsive */
@media (max-width: 768px) {
  .yt-grid { grid-template-columns: 1fr; gap: 36px; }
  .sec-title { font-size: 1.6rem; }
}
</style>