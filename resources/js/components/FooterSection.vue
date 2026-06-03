<template>
  <footer class="footer-section">
    <div class="container">

      <div class="footer-grid">

        <!-- Col 1: Brand -->
        <div class="footer-brand">
          <div class="footer-logo">
            <i class="fas fa-graduation-cap"></i>
            Univ Prep Hub
          </div>
          <p class="footer-tagline">Education for everyone</p>
          <p class="footer-desc">
            Build skills with courses, certificates and get online knowledge from
            our world-class platform.
          </p>
          <div class="footer-contact-list">
            <p class="footer-contact">
              <i class="fas fa-phone"></i> +91 9891460883
            </p>
            <p class="footer-contact">
              <i class="fas fa-envelope"></i> support@univprephub.com
            </p>
          </div>
        </div>

        <!-- Col 2: Quick Links -->
        <div class="footer-col">
          <h6 class="footer-col-title">Quick Links</h6>
          <ul class="footer-links">
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/courses">All Courses</router-link></li>
            <li><router-link to="/about">About Us</router-link></li>
            <li><router-link to="/contact">Contact Us</router-link></li>
            <li><router-link to="/faq">FAQ</router-link></li>
            <li><router-link to="/become-teacher">Become a Teacher</router-link></li>
          </ul>
        </div>

        <!-- Col 3: Help & Support + Newsletter -->
        <div class="footer-col">
          <h6 class="footer-col-title">Help &amp; Support</h6>
          <ul class="footer-links">
            <li><router-link to="/contact">Contact Us</router-link></li>
            <li><router-link to="/terms">Terms &amp; Conditions</router-link></li>
            <li><router-link to="/privacy">Privacy Policy</router-link></li>
            <li><router-link to="/login">Login</router-link></li>
          </ul>

          <h6 class="footer-col-title mt-4">Subscribe Newsletter</h6>
          <div class="newsletter">
            <input type="email" placeholder="Your email" class="newsletter-input" />
            <button class="newsletter-btn">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </div>

        <!-- Col 4: Socials & App -->
        <div class="footer-col">
          <h6 class="footer-col-title">Socials</h6>
          <div class="social-list">
            <a href="#" class="social-link social-insta">
              <i class="fab fa-instagram"></i> Instagram
            </a>
            <a href="#" class="social-link social-whatsapp">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.youtube.com/@UnivPrepHub" target="_blank" class="social-link social-youtube">
              <i class="fab fa-youtube"></i> YouTube
            </a>
          </div>

          <h6 class="footer-col-title mt-4">Download Our App</h6>
          <div class="app-badges">
            <a href="#" class="app-badge">
              <i class="fab fa-apple"></i> App Store
            </a>
            <a href="#" class="app-badge">
              <i class="fab fa-google-play"></i> Google Play
            </a>
          </div>
        </div>

      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <p>© 2024 UnivPrepHub. All rights reserved.</p>
        <div class="footer-bottom-links">
          <router-link to="/privacy">Privacy Policy &amp; T&amp;C</router-link>
          <span class="divider">|</span>
          <router-link to="/refund">Refund Policy</router-link>
          <span class="divider">|</span>
          <router-link to="/about">About us</router-link>
        </div>
      </div>

    </div>
  </footer>
</template>

<script setup>
</script>

<style scoped>
.footer-section {
  background: #0f172a;
  color: #94a3b8;
  padding: 64px 0 0;
  font-family: 'Poppins', sans-serif;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Grid */
.footer-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1.4fr 1.4fr;
  gap: 40px;
  margin-bottom: 48px;
}

/* Brand */
.footer-logo {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 1.2rem;
  font-weight: 900;
  color: #fff;
  margin-bottom: 8px;
}
.footer-logo i { color: #f5c518; }

.footer-tagline {
  color: #f5c518;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 12px;
}

.footer-desc {
  font-size: 0.82rem;
  color: #64748b;
  line-height: 1.7;
  margin-bottom: 16px;
}

.footer-contact-list { display: flex; flex-direction: column; gap: 6px; }

.footer-contact {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.8rem;
  color: #64748b;
  margin: 0;
}
.footer-contact i { color: #4f46e5; width: 16px; }

/* Columns */
.footer-col-title {
  color: #fff;
  font-weight: 700;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  margin-bottom: 14px;
}
.footer-col-title.mt-4 { margin-top: 24px; }

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.footer-links li a {
  color: #64748b;
  text-decoration: none;
  font-size: 0.83rem;
  transition: color 0.2s;
}
.footer-links li a:hover { color: #fff; }

/* Newsletter */
.newsletter {
  display: flex;
  gap: 8px;
  margin-top: 8px;
}

.newsletter-input {
  flex: 1;
  padding: 9px 12px;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 8px;
  color: #e2e8f0;
  font-size: 0.8rem;
  outline: none;
  transition: border-color 0.2s;
}
.newsletter-input::placeholder { color: #475569; }
.newsletter-input:focus { border-color: #4f46e5; }

.newsletter-btn {
  padding: 9px 14px;
  background: #4f46e5;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.85rem;
  transition: background 0.2s;
}
.newsletter-btn:hover { background: #4338ca; }

/* Socials */
.social-list {
  display: flex;
  flex-direction: column;
  gap: 9px;
}

.social-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  border-radius: 10px;
  font-size: 0.82rem;
  font-weight: 600;
  text-decoration: none;
  width: fit-content;
  transition: all 0.2s;
}
.social-link:hover { transform: translateX(3px); filter: brightness(1.2); }

.social-insta    { background: rgba(225, 48, 108, 0.12); color: #f472b6; border: 1px solid rgba(225, 48, 108, 0.2); }
.social-whatsapp { background: rgba(37, 211, 102, 0.1);  color: #4ade80; border: 1px solid rgba(37, 211, 102, 0.2); }
.social-youtube  { background: rgba(255, 0, 0, 0.1);     color: #f87171; border: 1px solid rgba(255, 0, 0, 0.2); }

/* App Badges */
.app-badges {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 8px;
}

.app-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 9px 16px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #e2e8f0;
  font-size: 0.82rem;
  font-weight: 600;
  text-decoration: none;
  width: fit-content;
  transition: all 0.2s;
}
.app-badge:hover { background: rgba(255, 255, 255, 0.12); color: #fff; }
.app-badge .fab  { color: #f5c518; }

/* Bottom */
.footer-bottom {
  padding: 18px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.07);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 0.78rem;
  color: #475569;
}

.footer-bottom p { margin: 0; }

.footer-bottom-links {
  display: flex;
  align-items: center;
  gap: 10px;
}

.footer-bottom-links a {
  color: #475569;
  text-decoration: none;
  transition: color 0.2s;
}
.footer-bottom-links a:hover { color: #f5c518; }

.divider { color: #334155; }

/* Responsive */
@media (max-width: 900px) {
  .footer-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
  .footer-grid { grid-template-columns: 1fr; }
  .footer-bottom { flex-direction: column; text-align: center; }
}
</style>