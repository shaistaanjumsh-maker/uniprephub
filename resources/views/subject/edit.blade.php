@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Edit Subject'))

@section('header-title')
    <h3 class="title">{{ __('Edit Subject') }}</h3>
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
                    <a href="{{ route('admin.subject.index') }}">{{ __('Subjects') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-pen-to-square"></i>
                    {{ __('Edit') }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{ route('admin.subject.update', $subject->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
                        </div>
                        <button class="btn btn-primary">{{ __('Update') }}</button>
                        <a href="{{ route('admin.subject.index') }}" class="btn btn-outline-secondary ms-2">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
