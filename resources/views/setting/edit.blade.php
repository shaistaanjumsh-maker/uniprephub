@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Settings'))

@section('header-title')
    <h3 class="title">{{ __('Settings') }}</h3>
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
                    {{ __('Settings') }}
                </li>
            </ol>
        </nav>
        <a href="javascript:void(0)" onclick="window.location.reload();" class="refresh-btn">
            <i class="fa-solid fa-retweet"></i>
            <span>{{ __('Refresh Page') }}</span>
        </a>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 my-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <form action="{{ route('admin.setting.update', ['setting' => $setting->id ?? 1]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                {{-- System Information --}}
                                <div class="col-md-12 mb-3">
                                    <h3 class="fw-bold text-primary border-bottom border-2 pb-3">
                                        {{ __('System Information') }}
                                    </h3>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('System Title') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="app_name"
                                        value="{{ config('app.name') }}" />
                                    @error('app_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Currency') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="app_currency"
                                        value="{{ config('app.currency') }}" />
                                    @error('app_currency')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Timezone') }}</label>
                                    <select class="form-select form-control" name="app_timezone">
                                        @foreach ($timezones as $timezone)
                                            <option value="{{ $timezone['zone'] }}"
                                                {{ $timezone['zone'] === config('app.timezone') ? 'selected' : '' }}>
                                                {{ $timezone['diff_from_GMT'] }} - {{ $timezone['zone'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Timezone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Currency Symbol') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="app_currency_symbol"
                                        value="{{ config('app.currency_symbol') }}" />
                                    @error('app_currency_symbol')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Currency Position') }}</label>
                                    <select class="form-select form-control" name="currency_position">
                                        <option value="Left" {{ $setting->currency_position === 'Left' ? 'selected' : '' }}>
                                            {{ __('Left') }}
                                        </option>
                                        <option value="Right" {{ $setting->currency_position === 'Right' ? 'selected' : '' }}>
                                            {{ __('Right') }}
                                        </option>
                                    </select>
                                    @error('currency_position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Minimum Amount to Buy Courses') }}
                                        <span style="font-size: 0.75rem; font-family: monospace;">({{ __('Depends on Region') }})</span>
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="app_minimum_amount"
                                        value="{{ config('app.minimum_amount') }}" />
                                    @error('app_minimum_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Footer Information --}}
                                <div class="col-md-12 my-3">
                                    <p class="fw-bold border-bottom border-2 pb-3">{{ __('Footer Information') }}</p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Footer text') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="footer_text"
                                        value="{{ $setting->footer_text }}" />
                                    @error('footer_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Footer Contact Number') }} (+tel)
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="tel" class="form-control" placeholder="+8801XXXXXXXXX"
                                        name="footer_contact_number"
                                        value="{{ $setting->footer_contact_number }}" />
                                    @error('footer_contact_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Footer Support Mail') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <input type="email" class="form-control" placeholder="support@example.com"
                                        name="footer_support_mail"
                                        value="{{ $setting->footer_support_mail }}" />
                                    @error('footer_support_mail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">{{ __('Footer Description') }}
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                    <textarea class="form-control" name="footer_description" rows="3"
                                        placeholder="{{ __('Footer Description') }}">{{ $setting->footer_description ?? '' }}</textarea>
                                    @error('footer_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- API Credentials --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="fw-bold border-bottom border-2 pb-3 text-primary">
                                        API {{ __('Credentials') }}
                                    </h3>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">JWT {{ __('Secret Key') }}</label>
                                    <input type="text" class="form-control" name="jwt_secret"
                                        value="{{ config('jwt.secret') ?? '' }}" />
                                    @error('jwt_secret')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Google Map --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="fw-bold border-bottom border-2 pb-3 text-primary">
                                        {{ __('Google Map Credentials (support only embed code)') }}
                                    </h3>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ __('Google Map Embed Code') }}</label>
                                    <input type="text" class="form-control" name="google_map_embed_code"
                                        value="{{ $setting->google_map_embed_code ?? '' }}" />
                                    @error('google_map_embed_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Whatsapp Support --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="fw-bold border-bottom border-2 pb-3 text-primary">
                                        {{ __('Support Whatsapp Credentials') }}
                                    </h3>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Whatsapp Support Title') }}</label>
                                    <input type="text" class="form-control" name="whatsapp_support_title"
                                        value="{{ $setting->whatsapp_support_title ?? 'Chat with us!' }}" />
                                    @error('whatsapp_support_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Whatsapp Number') }}</label>
                                    <input type="text" class="form-control" name="whatsapp_support_number"
                                        placeholder="+** 1234567890"
                                        value="{{ $setting->whatsapp_support_number ?? '' }}" />
                                    @error('whatsapp_support_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="col-md-12 mt-2 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary px-5 py-2">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
    {{-- End container-fluid --}}

@endsection