@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Page List'))

@section('header-title')
    <h3 class="title">{{ __('Pages') }}</h3>
@endsection

@section('content')
    <!-- ****Body-Section***** -->
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
                            {{ __('Pages') }}
                        </li>
                    </ol>
                </nav>
                <a href="javascript:void(0)" onclick="window.location.reload();" class="refresh-btn">
                    <i class="fa-solid fa-retweet"></i>
                    <span>{{ __('Refresh Page') }}</span>
                </a>
            </div>

            <div class="row" id="deleteTableItem">
                <div class="col-md-12 my-3">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table id="dataTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>{{ __('Page Title') }}</strong></th>
                                            <th><strong>{{ __('Slug') }}</strong></th>
                                            <th><strong>{{ __('Action') }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $page)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">{{ $page->title }}</td>
                                                <td class="tableId">{{ $page->slug }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit Page Content"
                                                            href="{{ route('admin.page.edit', $page->slug) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}

        <!-- ****End-Body-Section**** -->
    {{-- </div> --}}
@endsection
