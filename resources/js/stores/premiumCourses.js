import { defineStore } from "pinia";
import axios from "axios";
import { useAuthStore } from "@/stores/auth";

export const usePremiumCoursesStore = defineStore("premiumCourses", {
    state: () => ({
        courses: [],
        course: null,
        enrolled: false,
        loading: false,
        error: null,
    }),
    actions: {
        async fetchVisibleCourses() {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.get(`/api/premium-courses/visible`);
                this.courses = response.data.data.courses || [];
            } catch (error) {
                this.error = error?.response?.data?.message || error.message;
            } finally {
                this.loading = false;
            }
        },

        async fetchCourse(id) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.get(`/api/premium-courses/${id}`);
                this.course = response.data.data.course;
                return this.course;
            } catch (error) {
                this.error = error?.response?.data?.message || error.message;
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async checkEnrollment(id) {
            const authStore = useAuthStore();
            this.enrolled = false;
            if (!authStore.userData || !authStore.authToken) {
                return false;
            }
            try {
                const response = await axios.get(`/api/premium-courses/${id}/enrolled`, {
                    headers: {
                        Authorization: `Bearer ${authStore.authToken}`,
                    },
                });
                this.enrolled = !!response.data.data.enrolled;
                return this.enrolled;
            } catch (error) {
                this.enrolled = false;
                return false;
            }
        },

        async enroll(id) {
            const authStore = useAuthStore();
            this.loading = true;
            try {
                const response = await axios.post(`/api/premium-courses/${id}/enroll`, null, {
                    headers: {
                        Authorization: `Bearer ${authStore.authToken}`,
                    },
                });
                this.enrolled = true;
                return response.data;
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async createCourse(payload) {
            this.loading = true;
            try {
                const formData = new FormData();
                Object.entries(payload).forEach(([key, value]) => {
                    if (value !== undefined && value !== null) {
                        formData.append(key, value);
                    }
                });
                const response = await axios.post(`/api/premium-courses`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                return response.data.data.course;
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async updateCourse(id, payload) {
            this.loading = true;
            try {
                const formData = new FormData();
                Object.entries(payload).forEach(([key, value]) => {
                    if (value !== undefined && value !== null) {
                        formData.append(key, value);
                    }
                });
                const response = await axios.put(`/api/premium-courses/${id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                return response.data.data.course;
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },
    },
});
