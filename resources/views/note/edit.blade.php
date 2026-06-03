@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Edit Note'))

@section('header-title')
    <h3 class="title">{{ __('Edit Note') }}</h3>
@endsection

@section('content')
            <div class="page-title-actions px-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <nav aria-label="breadcrumb" class="modern-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-house"></i>
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.note.index') }}">{{ __('Notes') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fa-solid fa-pen-to-square"></i>
                            {{ __('Edit') }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.note.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Title') }}</label>
                                        <input id="note_title" type="text" name="title" value="{{ old('title', $note->title) }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Slug') }}</label>
                                        <input id="note_slug" type="text" name="slug" value="{{ old('slug', $note->slug) }}" class="form-control" required>
                                        <small class="text-muted d-block mt-1">
                                            {{ __('URL preview:') }}
                                            <a id="note_slug_preview" href="{{ url('/notes/' . old('slug', $note->slug)) }}" target="_blank">{{ url('/notes/' . old('slug', $note->slug)) }}</a>
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Subject') }}</label>
                                        <select name="subject" class="form-select">
                                            <option value="">{{ __('Select subject') }}</option>
                                            @foreach($subjects ?? [] as $s)
                                                <option value="{{ $s }}" {{ old('subject', $note->subject) == $s ? 'selected' : '' }}>{{ $s }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <textarea name="description" rows="5" class="form-control">{{ old('description', $note->description) }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('PDF File') }}</label>
                                        <input type="file" name="pdf" class="form-control" accept="application/pdf">
                                        <small class="text-muted">{{ __('Leave blank to keep current PDF file') }}</small>
                                        @if ($note->pdf_path)
                                            <div class="mt-2">
                                                <a href="{{ $note->pdf_url }}" target="_blank" class="text-decoration-none">
                                                    <i class="fa-solid fa-file-pdf text-danger me-1"></i> {{ __('View current PDF') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Thumbnail') }}</label>
                                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                        @if ($note->thumbnail_path)
                                            <img src="{{ $note->thumbnail_url }}" alt="Thumbnail" class="img-thumbnail mt-2" width="120">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Tags') }}</label>
                                        <input type="text" name="tags" value="{{ old('tags', $note->tags) }}" class="form-control" placeholder="{{ __('comma separated') }}">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center gap-2">
                                        <input type="hidden" name="is_published" value="0">
                                        <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $note->is_published) ? 'checked' : '' }}>
                                        <label for="is_published" class="mb-0">{{ __('Published') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> {{ __('Update Note') }}
                                        </button>
                                        <a href="{{ route('admin.note.index') }}" class="btn btn-outline-secondary ms-2">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const titleInput = document.getElementById('note_title');
                    const slugInput = document.getElementById('note_slug');
                    const previewLink = document.getElementById('note_slug_preview');
                    let lastGenerated = slugInput.value;

                    const generateSlug = (value) => {
                        return value
                            .toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '')
                            .trim()
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                    };

                    const updatePreview = () => {
                        const slugValue = slugInput.value || '';
                        if (previewLink) {
                            previewLink.href = '/notes/' + slugValue;
                            previewLink.textContent = window.location.origin + '/notes/' + slugValue;
                        }
                    };

                    if (titleInput && slugInput) {
                        titleInput.addEventListener('input', function () {
                            if (!slugInput.value || slugInput.value === lastGenerated) {
                                lastGenerated = generateSlug(titleInput.value);
                                slugInput.value = lastGenerated;
                                updatePreview();
                            }
                        });

                        slugInput.addEventListener('input', function () {
                            lastGenerated = slugInput.value;
                            updatePreview();
                        });

                        updatePreview();
                    }
                });
            </script>
@endsection
