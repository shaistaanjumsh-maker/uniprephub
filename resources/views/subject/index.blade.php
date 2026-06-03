@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Subjects'))

@section('header-title')
    <h3 class="title">{{ __('Subjects') }}</h3>
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
                    <i class="fa-solid fa-list"></i>
                    {{ __('Subjects') }}
                </li>
            </ol>
        </nav>
        <a href="{{ route('admin.subject.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus me-1"></i> {{ __('Add Subject') }}
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
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->id }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.subject.edit', $subject->id) }}" class="btn btn-sm btn-outline-primary">{{ __('Edit') }}</a>
                                            <form action="{{ route('admin.subject.destroy', $subject->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Delete subject?') }}')">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
