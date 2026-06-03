<template>
    <section class="notes-page container py-5">
        <div class="d-flex align-items-start justify-content-between mb-4 gap-3 flex-wrap">
            <div>
                <h1 class="mb-1 display-6">{{ $t('Notes') }}</h1>
                <p class="text-muted mb-0">{{ $t('Browse published notes and download PDF resources for study.') }}</p>
                <a href="https://www.youtube.com/@univprephub8288" target="_blank" rel="noopener noreferrer" class="d-inline-block mt-2 text-decoration-none">
                    <i class="fa-brands fa-youtube text-danger me-1"></i> {{ $t('Watch learning videos') }}
                </a>
            </div>

            <div class="d-flex gap-2 w-100 w-lg-auto">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input v-model="search" type="text" class="form-control" :placeholder="$t('Search by title')" />
                </div>
                <select v-model="subject" class="form-select">
                    <option value="">{{ $t('All Subjects') }}</option>
                    <option v-for="option in subjects" :key="option" :value="option">{{ option }}</option>
                </select>
            </div>
        </div>

        <div v-if="loading" class="row g-4">
            <div class="col-md-6 col-xl-4" v-for="n in 6" :key="n">
                <div class="card note-card h-100">
                    <div class="skeleton-img"></div>
                    <div class="card-body">
                        <div class="skeleton-line w-75 mb-2"></div>
                        <div class="skeleton-line w-50 mb-2"></div>
                        <div class="skeleton-line w-100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else>
            <div v-if="error" class="alert alert-danger">{{ error }}</div>

            <div v-if="filteredNotes.length === 0 && !error" class="text-center py-5">
                <h5>{{ $t('No notes available') }}</h5>
                <p class="text-muted mb-0">{{ $t('Try another subject or search term.') }}</p>
            </div>

            <div v-else class="row g-4">
                <div class="col-md-6 col-xl-4" v-for="note in filteredNotes" :key="note.id">
                    <div class="card note-card h-100 shadow-sm">
                        <img :src="note.thumbnail_url" class="card-img-top" alt="Note thumbnail" />
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2 d-flex justify-content-between align-items-start">
                                <span class="badge bg-secondary text-uppercase">{{ note.subject || $t('General') }}</span>
                                <div class="text-muted small">{{ formatDate(note.created_at) }}</div>
                            </div>

                            <h5 class="card-title">{{ note.title }}</h5>

                            <div v-if="note.tags && note.tags.length" class="mb-2">
                                <span v-for="tag in note.tags" :key="tag" class="tag-chip">{{ tag }}</span>
                            </div>

                            <p class="card-text text-muted flex-grow-1">{{ note.description?.length > 140 ? note.description.slice(0, 140) + '...' : note.description }}</p>

                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <div class="text-muted small">{{ note.created_at ? new Date(note.created_at).toLocaleString() : '' }}</div>
                                <div class="d-flex gap-2">
                                    <router-link :to="`/notes/${note.slug}`" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-eye"></i> {{ $t('View') }}
                                    </router-link>
                                    <a :href="note.pdf_download_url" class="btn btn-secondary btn-sm d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-download"></i> {{ $t('Download') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted, computed, ref } from 'vue';

const notes = ref([]);
const loading = ref(true);
const error = ref('');
const search = ref('');
const subject = ref('');
const subjects = ref([]);

const loadNotes = async () => {
    loading.value = true;
    error.value = '';

    try {
        const response = await axios.get('/notes/list');
        // Resource wraps notes as NoteResource collection; unwrap
        notes.value = response.data.data.notes || [];
        subjects.value = response.data.data.subjects || [];
    } catch (err) {
        error.value = err.response?.data?.message || 'Unable to load notes.';
    } finally {
        loading.value = false;
    }
};

const filteredNotes = computed(() => {
    return notes.value.filter((item) => {
        const matchesSearch = search.value
            ? (item.title || '').toLowerCase().includes(search.value.toLowerCase())
            : true;
        const matchesSubject = subject.value ? (item.subject || '') === subject.value : true;
        return matchesSearch && matchesSubject;
    });
});

const formatDate = (d) => {
    if (!d) return '';
    try {
        return new Date(d).toLocaleDateString();
    } catch (e) {
        return d;
    }
};

onMounted(() => {
    loadNotes();
});
</script>

<style scoped>
.notes-page h1 {
    font-weight: 600;
}
.note-card {
    border: 0;
    overflow: hidden;
    transition: transform .18s ease, box-shadow .18s ease;
}
.note-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.note-card .card-img-top {
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid rgba(0,0,0,0.04);
}
.tag-chip {
    display: inline-block;
    background: #f1f3f5;
    border-radius: 999px;
    padding: 4px 8px;
    margin-right: 6px;
    font-size: 0.78rem;
    color: #495057;
}
.skeleton-img { height: 200px; background: linear-gradient(90deg,#f4f4f4,#ececec,#f4f4f4); background-size: 200% 100%; animation: shimmer 1.2s infinite; }
.skeleton-line { height: 12px; background: #f4f4f4; border-radius: 6px; }
@keyframes shimmer { 0% { background-position: -200% 0 } 100% { background-position: 200% 0 } }
</style>
