@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Premium Courses'))

@section('header-title')
    <h3 class="title">{{ __('Premium Courses') }}</h3>
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
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-certificate"></i>
                    {{ __('Premium Courses') }}
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.premium-courses.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus me-1"></i> {{ __('Add Course') }}
        </a>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Sr.') }}</th>
                                    <th>{{ __('Thumbnail') }}</th>
                                    <th>{{ __('Subject') }}</th>
                                    <th>{{ __('Topic Name') }}</th>
                                    <th>{{ __('Video') }}</th>
                                    <th>{{ __('PDF') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $index => $course)
                                    <tr id="course-row-{{ $course->id }}">
                                        <td>{{ $courses->firstItem() + $index }}</td>
                                        <td>
                                            @if($course->thumbnail)
                                                <img src="{{ Storage::url($course->thumbnail) }}" alt="Thumbnail" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                            @else
                                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-muted" style="width: 50px; height: 50px; border: 1px solid #dee2e6;">
                                                    <i class="bi bi-image fs-5"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $course->subject?->name ?? '-' }}</td>
                                        <td>{{ $course->topic_name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $course->video_url ? 'success' : 'secondary' }}">
                                                {{ $course->video_url ? __('Yes') : __('No') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $course->pdf_file ? 'success' : 'secondary' }}">
                                                {{ $course->pdf_file ? __('Yes') : __('No') }}
                                            </span>
                                        </td>
                                        <td>₹ {{ number_format($course->price, 2) }}</td>
                                        <td id="status-label-{{ $course->id }}">
                                            <span class="badge bg-{{ $course->status === 'visible' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($course->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.premium-courses.edit', $course->id) }}" class="btn btn-sm btn-outline-primary mb-1">{{ __('Edit') }}</a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="toggleStatus({{ $course->id }})">
                                                {{ $course->status === 'visible' ? __('Hide') : __('Show') }}
                                            </button>
                                            <form action="{{ route('admin.premium-courses.destroy', $course->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('Delete this course?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger mb-1">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        async function toggleStatus(courseId) {
            try {
                const response = await axios.patch(`/api/premium-courses/${courseId}/toggle`);
                const status = response.data.data.status;
                const statusLabel = document.getElementById(`status-label-${courseId}`);
                if (statusLabel) {
                    statusLabel.innerHTML = `<span class="badge bg-${status === 'visible' ? 'success' : 'secondary'}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
                }
                const button = document.querySelector(`#course-row-${courseId} button`);
                if (button) {
                    button.textContent = status === 'visible' ? '{{ __('Hide') }}' : '{{ __('Show') }}';
                }
                Swal.fire({
                    icon: 'success',
                    title: '{{ __('Status updated') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                });
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __('Unable to update status') }}',
                    text: error?.response?.data?.message || '{{ __('Please try again later.') }}',
                });
            }
        }
    </script>
@endsection
