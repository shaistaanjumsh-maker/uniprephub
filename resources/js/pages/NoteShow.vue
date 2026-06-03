<template>
    <section class="note-view-page container py-5">
        <div v-if="loading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-else-if="error" class="alert alert-danger">
            {{ error }}
        </div>

        <div v-else>
            <div class="mb-4">
                <h1 class="display-6">{{ note.title }}</h1>
                <span class="badge bg-secondary text-uppercase">
                    {{ note.subject || $t('General') }}
                </span>
            </div>

            <p class="text-muted mb-4">{{ note.description }}</p>

            <div class="ratio ratio-16x9 note-pdf-frame">
                <iframe
                    v-if="note.pdf_url"
                    :src="note.pdf_url + '#toolbar=0'"
                    frameborder="0"
                    style="width:100%; height:100%;"
                ></iframe>
                <div v-else class="alert alert-warning">
                    {{ $t('PDF not available for this note.') }}
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const note = ref(null);
const loading = ref(true);
const error = ref('');

const loadNote = async () => {
    loading.value = true;
    error.value = '';

    try {
        const response = await axios.get(`/notes/slug/${route.params.slug}`);
        note.value = response.data.data.note;
    } catch (err) {
        error.value = err.response?.data?.message || 'Note not found.';
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    loadNote();
});
</script>

<style scoped>
.note-view-page h1 {
    font-weight: 700;
}
.note-pdf-frame {
    min-height: 70vh;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 0.5rem;
    overflow: hidden;
}
</style>
