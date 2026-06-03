<template>
  <div class="achievement-ticker-wrapper py-2">
    <div class="ticker-label">
      <i class="fas fa-trophy"></i>
      <span>Achievements</span>
    </div>
    <div class="ticker-mask">
      <div class="ticker-track">
        <div
          v-for="(item, i) in [...achievers, ...achievers]"
          :key="'tick-' + i"
          class="ticker-chip"
        >
          <div class="chip-avatar">{{ item.name.charAt(0) }}</div>
          <div class="chip-info">
            <span class="chip-name">{{ item.name }}</span>
            <span class="chip-meta">{{ item.degree }} · {{ item.university }}</span>
          </div>
          <span class="chip-medal">🏅</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const achievers = ref([
  { name: "Mariam Parwej",  degree: "BA(HONS)",          university: "Jamia Millia Islamia"  },
  { name: "Priyanghi",      degree: "BSW",                university: "Jamia Millia Islamia"  },
  { name: "Rais",           degree: "BA(HONS) History",   university: "Jamia Millia Islamia"  },
  { name: "Muneer",         degree: "BA(HONS) History",   university: "Jamia Millia Islamia"  },
  { name: "Znooran Javad",  degree: "BA(HONS) History",   university: "Jamia Millia Islamia"  },
  { name: "Saliq Ahmed M.", degree: "BA(HONS) History",   university: "Jamia Millia Islamia"  },
  { name: "Mohd Adil Baig", degree: "B.A. Hons. (Arts)",  university: "Aligarh Muslim Univ."  },
  { name: "Ali Tariq",      degree: "B.Com Hons.",         university: "Aligarh Muslim Univ."  },
  { name: "Mohd Asim",      degree: "B.Hons. Arts",        university: "Aligarh Muslim Univ."  },
  { name: "Prince",         degree: "B.Hons. Geography",   university: "Jamia Millia Islamia"  },
  { name: "Samara Illarie", degree: "B.Hons. Geography",   university: "Jamia Millia Islamia"  },
  { name: "Mohd Rial",      degree: "B.Hons. Geography",   university: "Jamia Millia Islamia"  },
]);
</script>

<style scoped>
.achievement-ticker-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  background: rgba(15, 23, 42, 0.95);
  color: #f8fafc;
  border-radius: 36px;
  padding: 16px 22px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  box-shadow: 0 28px 80px rgba(15, 23, 42, 0.18);
  position: sticky;
  top: 14px;
  z-index: 20;
  backdrop-filter: blur(12px);
}

.achievement-ticker-wrapper::before {
  content: '';
  position: absolute;
  top: 12px;
  right: 24px;
  width: 140px;
  height: 140px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(79, 70, 229, 0.18) 0%, transparent 60%);
  pointer-events: none;
}

.ticker-label {
  background: linear-gradient(135deg, rgba(245, 197, 24, 0.16), rgba(245, 197, 24, 0.06));
  color: #f5c518;
  font-weight: 800;
  font-size: 0.78rem;
  letter-spacing: 1.6px;
  text-transform: uppercase;
  padding: 14px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
  border-radius: 999px;
  box-shadow: 0 10px 28px rgba(245, 197, 24, 0.08);
}

.ticker-mask {
  flex: 1;
  overflow: hidden;
  min-width: 0;
  mask-image: linear-gradient(to right, transparent 0%, #000 8%, #000 92%, transparent 100%);
}

.ticker-track {
  display: flex;
  gap: 18px;
  padding: 10px 0;
  width: max-content;
  animation: ticker-scroll 30s linear infinite;
}
.ticker-track:hover { animation-play-state: paused; }

@keyframes ticker-scroll {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

.ticker-chip {
  display: flex;
  align-items: center;
  gap: 14px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 999px;
  padding: 12px 20px;
  white-space: nowrap;
  cursor: default;
  transition: transform 0.25s ease, background 0.25s ease, border-color 0.25s ease;
}
.ticker-chip:hover {
  transform: translateY(-2px);
  background: rgba(255, 255, 255, 0.12);
  border-color: rgba(245, 197, 24, 0.28);
}

.chip-avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4f46e5, #818cf8);
  color: #fff;
  font-weight: 800;
  font-size: 0.98rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid rgba(245, 197, 24, 0.85);
  flex-shrink: 0;
}

.chip-info {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.chip-name {
  color: #f8fafc;
  font-weight: 700;
  font-size: 0.82rem;
  line-height: 1.2;
}

.chip-meta {
  color: #cbd5e1;
  font-size: 0.7rem;
  line-height: 1.3;
}

.chip-medal {
  font-size: 1.1rem;
  flex-shrink: 0;
}

@media (max-width: 768px) {
  .achievement-ticker-wrapper {
    flex-direction: column;
    align-items: stretch;
    top: 0;
    padding: 16px;
  }

  .achievement-ticker-wrapper::before {
    display: none;
  }

  .ticker-track {
    gap: 14px;
  }
}
</style>