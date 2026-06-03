<template>
  <div class="univprep-home">
    <Hero />
    <AchievementsTicker />
    <AboutSection />
    <WhatIsOnPlatform />
    <LatestCourseSlider />
    <YouTubeSection />
    <LiveQuizMockTest />
    <Testimonials />
    <AchievementsGrid />
    <Footer />
    <OfferModal />
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { useMasterStore } from "@/stores/master";
import { useLocaleStore } from "../stores/locale";

import Hero                from "../components/Hero.vue";
import AchievementsTicker  from "../components/AchievementsTicker.vue";
import AboutSection        from "../components/AboutSection.vue";
import WhatIsOnPlatform    from "../components/WhatIsOnPlatform.vue";
import NewCourses          from "../components/NewCourses.vue";
import YouTubeSection      from "../components/YouTubeSection.vue";
import LiveQuizMockTest    from "../components/LiveQuizMockTest.vue";
import TestimonialsSection from "../components/TestimonialsSection.vue";
import AchievementsGrid    from "../components/AchievementsGrid.vue";
import FooterSection       from "../components/FooterSection.vue";
import OfferModal          from "../components/OfferModal.vue";

const masterStore = useMasterStore();
const localeStore = useLocaleStore();

onMounted(async () => {
  try {
    const res = await axios.get(`/master`, {
      headers: { "Content-Type": "application/json", Accept: "application/json" },
    });
    masterStore.setMasterData(res.data.data.master);
    if (localeStore.defaultLanguage !== masterStore.masterData.default_language) {
      localeStore.setLang(masterStore.masterData.default_language);
      localeStore.setDefaultLang(masterStore.masterData.default_language);
      location.reload();
    }
  } catch (err) {
    console.error("Master fetch error:", err);
  }
});
</script>

<style scoped>
.univprep-home { font-family: 'Poppins', sans-serif; }
</style>