<template>
    <footer :class="{ 'homepage-footer': $route.path === '/' }" class="footer-wrapper text-white" :style="{
        backgroundImage: masterStore?.masterData?.footer_bg_thumbnail
            ? `url(${masterStore.masterData.footer_bg_thumbnail})`
            : 'url(/assets/website/footer-bg-2.png)',
        backgroundRepeat: 'no-repeat',
        backgroundPosition: 'center',
        backgroundSize: 'cover'
    }">
        <section class="container footer-content">
            <div class="row g-4">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="footer-brand">
                        <img class="mb-3" :src="masterStore?.masterData?.footer" width="140px" height="55px" :alt="$t('Brand Logo')" />
                        <p class="footer-desc">
                            {{ masterStore?.masterData?.footer_description }}
                        </p>
                        <div class="contact-info mt-4">
                            <div class="contact-item mb-3">
                                <i class="bi bi-telephone me-2"></i>
                                <a :href="`tel:${masterStore?.masterData?.footer_contact}`">
                                    {{ masterStore?.masterData?.footer_contact }}
                                </a>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope me-2"></i>
                                <a :href="`mailto:${masterStore?.masterData?.footer_email}`">
                                    {{ masterStore?.masterData?.footer_email }}
                                </a>
                            </div>
                        </div>
                        <div class="social-links mt-4">
                            <a v-for="social in masterStore?.masterData?.footer_social_icons" :key="social.name" :href="social?.url" target="_blank" class="social-icon" :title="social.name">
                                <i :class="social?.icon"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-2">
                    <div class="footer-section">
                        <h5 class="footer-title">{{ $t('Quick Links') }}</h5>
                        <ul class="footer-list">
                            <li>
                                <router-link to="/courses">{{ $t('All Courses') }}</router-link>
                            </li>
                            <li>
                                <router-link to="/page/about_us">{{ $t('About Us') }}</router-link>
                            </li>
                            <li>
                                <router-link to="/faq">{{ $t('FAQ') }}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Help & Support -->
                <div class="col-lg-3 col-md-6 mb-2">
                    <div class="footer-section">
                        <h5 class="footer-title">{{ $t('Help & Support') }}</h5>
                        <ul class="footer-list">
                            <li>
                                <router-link to="/contact-us">{{ $t('Contact Us') }}</router-link>
                            </li>
                            <li>
                                <router-link to="/page/terms_and_conditions">{{ $t('Terms & Conditions') }}</router-link>
                            </li>
                            <li>
                                <router-link to="/page/privacy_policy">{{ $t('Privacy Policy') }}</router-link>
                            </li>
                            <li>
                                <a href="/admin/login" target="_blank">{{ $t('Login to Admin') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-3 col-md-6 mb-2">
                    <div class="footer-section">
                        <h5 class="footer-title">{{ $t('Subscribe to Newsletter') }}</h5>
                        <p class="footer-sub-text">{{ $t('Get latest courses and updates') }}</p>
                        <form @submit.prevent="newsletter()" class="newsletter-form">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" :placeholder="$t('Enter your email')" v-model="suscribeEmail" required />
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                            <small class="form-text">{{ $t('No spam. Unsubscribe anytime.') }}</small>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="text-center py-3">
                    <small>{{ masterStore?.masterData?.credit_text }}</small>
                </div>
            </div>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
.footer-wrapper {
    background-size: cover;
    background-position: center;
    margin-top: 80px;
}

.footer-content {
    padding: 60px 0 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}

/* Brand Section */
.footer-brand {
    max-width: 320px;

    img {
        display: block;
        object-fit: contain;
    }
}

.footer-desc {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.75);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.contact-info {
    .contact-item {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.75);

        i {
            color: #4f46e5;
            font-size: 1rem;
        }

        a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s ease;

            &:hover {
                color: #4f46e5;
            }
        }
    }
}

.social-links {
    display: flex;
    gap: 14px;

    .social-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(79, 70, 229, 0.15);
        color: #fff;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.25s ease;

        &:hover {
            background: #4f46e5;
            transform: translateY(-3px);
        }
    }
}

/* Footer Sections */
.footer-section {
    .footer-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .footer-sub-text {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.65);
        margin-bottom: 1.2rem;
    }
}

.footer-list {
    list-style: none;
    padding: 0;
    margin: 0;

    li {
        margin-bottom: 0.9rem;

        a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;

            &:before {
                content: '›';
                margin-right: 6px;
                color: #4f46e5;
                font-weight: bold;
                opacity: 0;
                transition: opacity 0.2s ease;
            }

            &:hover {
                color: #ffffff;
                padding-left: 6px;

                &:before {
                    opacity: 1;
                }
            }
        }
    }
}

/* Newsletter Form */
.newsletter-form {
    .input-group {
        display: flex;
        gap: 0;
        border-radius: 8px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: all 0.2s ease;

        &:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #4f46e5;
        padding: 10px 14px;
        flex-shrink: 0;
    }

    .form-control {
        background: transparent;
        border: none;
        color: #ffffff;
        padding: 10px 8px;
        font-size: 0.9rem;

        &::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        &:focus {
            border: none;
            box-shadow: none;
            color: #ffffff;
        }
    }

    .btn {
        background: #4f46e5;
        border: none;
        padding: 10px 16px;
        color: white;
        font-size: 0.9rem;
        transition: background 0.2s ease;

        &:hover {
            background: #3730a3;
            color: white;
        }
    }

    .form-text {
        display: block;
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 0.5rem;
    }
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.08);

    small {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .footer-content {
        padding: 50px 0 0;
    }
}

@media (max-width: 768px) {
    .footer-wrapper {
        margin-top: 60px;
    }

    .footer-content {
        padding: 40px 0 0;
    }

    .footer-brand {
        max-width: 100%;
        margin-bottom: 30px;
    }

    .footer-section {
        margin-bottom: 20px;

        .footer-title {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
    }

    .social-links {
        margin-top: 1.5rem;
    }

    .footer-list li {
        margin-bottom: 0.7rem;

        a {
            font-size: 0.85rem;
        }
    }

    .newsletter-form {
        .input-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
}

@media (max-width: 576px) {
    .footer-content {
        padding: 30px 0 0;
    }

    .footer-brand img {
        width: 120px !important;
        height: 45px !important;
    }

    .footer-section .footer-title {
        font-size: 0.85rem;
    }

    .social-links {
        gap: 10px;

        .social-icon {
            width: 34px;
            height: 34px;
            font-size: 0.8rem;
        }
    }
}
</style>

<script setup>
import { useMasterStore } from "@/stores/master";
import { ref } from "vue";
import Swal from "sweetalert2";

const masterStore = useMasterStore();
const masterData = ref(masterStore.masterData);
const suscribeEmail = ref("");
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const baseUrl = import.meta.env.VITE_APP_URL;


const newsletter = () => {

    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailRegex.test(suscribeEmail.value)) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: "Invalid email address"
        });
        return;
    }

    axios.post("/newslatter/subscribe", {
        email: suscribeEmail.value
    })
        .then((response) => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: t("Thank you for subscribing to our newsletter")
            });
        }).catch((error) => {
            console.log(error);

        })
    suscribeEmail.value = "";
};
</script>
