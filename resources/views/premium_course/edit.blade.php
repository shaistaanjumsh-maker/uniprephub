@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Edit Premium Course'))

@section('header-title')
    <h3 class="title">{{ __('Edit Premium Course') }}</h3>
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
                    <a href="{{ route('admin.premium-courses.index') }}">{{ __('Premium Courses') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-pen-to-square"></i>
                    {{ __('Edit Course') }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{ route('admin.premium-courses.update', $premiumCourse->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Subject') }}</label>
                                <select name="subject_id" class="form-select" required>
                                    <option value="">{{ __('Select subject') }}</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id', $premiumCourse->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Topic Name') }}</label>
                                <input type="text" name="topic_name" class="form-control" placeholder="{{ __('Topic Name') }}" value="{{ old('topic_name', $premiumCourse->topic_name) }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="{{ __('Course description') }}" required>{{ old('description', $premiumCourse->description) }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Price') }}</label>
                                <input type="number" name="price" class="form-control" placeholder="{{ __('Price in ₹') }}" value="{{ old('price', $premiumCourse->price) }}" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Video URL') }}</label>
                                <input type="text" name="video_url" class="form-control" placeholder="{{ __('YouTube URL (optional)') }}" value="{{ old('video_url', $premiumCourse->video_url) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Thumbnail Image') }}</label>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*" id="thumbnail-input">
                                <div class="mt-3" id="thumbnail-preview" style="display: block;">
                                    <img id="thumbnail-preview-image" data-original-src="{{ $premiumCourse->thumbnail ? Storage::url($premiumCourse->thumbnail) : '' }}" src="{{ $premiumCourse->thumbnail ? Storage::url($premiumCourse->thumbnail) : '' }}" alt="Thumbnail Preview" class="img-fluid rounded" style="max-height: 150px; border: 1px solid #dee2e6; {{ $premiumCourse->thumbnail ? '' : 'display: none;' }}">
                                    <div id="thumbnail-preview-placeholder" class="border rounded p-3 text-center text-muted" style="{{ $premiumCourse->thumbnail ? 'display: none;' : 'display: block;' }}">
                                        <i class="bi bi-image fs-2"></i>
                                        <div class="small mt-2">{{ __('No thumbnail selected') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('PDF File') }}</label>
                                <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                                @if($premiumCourse->pdf_file)
                                    <div class="form-text">{{ __('Current file:') }} {{ basename($premiumCourse->pdf_file) }}</div>
                                @endif
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Features') }} ({{ __('One per line') }})</label>
                                <textarea name="features" class="form-control" rows="5" placeholder="{{ __('Live Classes') }}&#10;{{ __('PDF Notes') }}&#10;{{ __('Mock Tests') }}&#10;{{ __('MCQs') }}&#10;{{ __('Doubt Resolution') }}&#10;{{ __('Lifetime Access') }}">{{ old('features', is_array($premiumCourse->features) ? implode("\n", $premiumCourse->features) : '') }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Duration Label') }}</label>
                                <input type="text" name="duration_label" class="form-control" placeholder="{{ __('Till exam') }}" value="{{ old('duration_label', $premiumCourse->duration_label) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Syllabus Label') }}</label>
                                <input type="text" name="syllabus_label" class="form-control" placeholder="{{ __('Complete JMI Entrance Exam') }}" value="{{ old('syllabus_label', $premiumCourse->syllabus_label) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Status') }}</label>
                                <select name="status" class="form-select" required>
                                    <option value="visible" {{ old('status', $premiumCourse->status) === 'visible' ? 'selected' : '' }}>{{ __('Visible') }}</option>
                                    <option value="hidden" {{ old('status', $premiumCourse->status) === 'hidden' ? 'selected' : '' }}>{{ __('Hidden') }}</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-success">{{ __('Update Course') }}</button>
                        <a href="{{ route('admin.premium-courses.index') }}" class="btn btn-outline-secondary ms-2">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('thumbnail-input');
            const previewImage = document.getElementById('thumbnail-preview-image');
            const previewPlaceholder = document.getElementById('thumbnail-preview-placeholder');

            if (input && previewImage && previewPlaceholder) {
                input.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (!file) {
                        const originalSrc = previewImage.dataset.originalSrc;
                        if (originalSrc) {
                            previewImage.src = originalSrc;
                            previewImage.style.display = 'block';
                            previewPlaceholder.style.display = 'none';
                        } else {
                            previewImage.src = '';
                            previewImage.style.display = 'none';
                            previewPlaceholder.style.display = 'block';
                        }
                        return;
                    }

                    previewImage.src = URL.createObjectURL(file);
                    previewImage.style.display = 'block';
                    previewPlaceholder.style.display = 'none';
                });
            }
        });
    </script>
@endsection
