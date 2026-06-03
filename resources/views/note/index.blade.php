@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Notes List'))

@section('header-title')
    <h3 class="title">{{ __('Notes') }}</h3>
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
                            <i class="fa-solid fa-layer-group"></i>
                            {{ __('Notes') }}
                        </li>
                    </ol>
                </nav>
                <a href="{{ route('admin.note.create') }}" class="btn btn-primary btn-sm shadow-sm rounded-pill px-4 py-2">
                    <i class="fa-solid fa-plus me-1"></i> {{ __('Add Note') }}
                </a>
            </div>

            <div class="row" id="deleteTableItem">
                <div class="col-md-12 my-3">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle modern-table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>{{ __('Title') }}</strong></th>
                                            <th><strong>{{ __('Subject') }}</strong></th>
                                            <th><strong>{{ __('Date') }}</strong></th>
                                            <th><strong>{{ __('Status') }}</strong></th>
                                            <th><strong>{{ __('Action') }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($notes as $note)
                                            <tr>
                                                <td>{{ generateID($notes->firstItem() + $loop->index) }}</td>
                                                <td>{{ $note->title }}</td>
                                                <td>{{ $note->subject ?: __('General') }}</td>
                                                <td>{{ $note->created_at?->format('d M Y') }}</td>
                                                <td>
                                                    @if ($note->is_published)
                                                        <span class="badge rounded-pill text-bg-success">{{ __('Published') }}</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-secondary">{{ __('Draft') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.note.edit', $note->id) }}" class="drop-item tooltip-custom">
                                                        <i class="fa-solid fa-pen-to-square me-1 text-warning"></i>
                                                        <span class="tooltip-text">{{ __('Edit Note') }}</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="drop-item tooltip-custom"
                                                        onclick="deleteAction('{{ route('admin.note.destroy', $note->id) }}')">
                                                        <i class="fa-solid fa-trash-can me-1 text-danger"></i>
                                                        <span class="tooltip-text">{{ __('Delete Note') }}</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">
                                                    {{ __('No notes available') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $notes->links() }}
                        </div>
                    </div>
                </div>
            </div>
@endsection
