@extends($activeTemplate.'layouts.master')

@section('content')

<div class="dashboard py-80 section-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include($activeTemplate.'components.sidebar')
            </div>
            <div class="col-xl-9 col-lg-12">
                <div class="dashboard-body">
                    <div class="row gy-4">
                        <div class="col-xl-10 col-lg-10">
                            <div class="user-profile">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">@lang('Current Password')</label>
                                        <input type="password" class="form-control form--control" name="current_password" required
                                            autocomplete="current-password">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">@lang('Password')</label>
                                        <input type="password" class="form-control form--control" name="password" required
                                            autocomplete="current-password">
                                        @if($general->secure_password)
                                        <div class="input-popup">
                                            <p class="error lower">@lang('1 small letter minimum')</p>
                                            <p class="error capital">@lang('1 capital letter minimum')</p>
                                            <p class="error number">@lang('1 number minimum')</p>
                                            <p class="error special">@lang('1 special character minimum')</p>
                                            <p class="error minimum">@lang('6 character password')</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 form-group mb-3">
                                        <label class="form-label">@lang('Confirm Password')</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form--control" name="password_confirmation"
                                            required autocomplete="current-password">
                                        </div>

                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script-lib')
<script src="{{ asset('assets/common/js/secure_password.js') }}"></script>
@endpush
@push('script')
<script>
    (function ($) {
        "use strict";
        @if ($general -> secure_password)
            $('input[name=password]').on('input', function () {
                secure_password($(this));
            });

        $('[name=password]').focus(function () {
            $(this).closest('.form-group').addClass('hover-input-popup');
        });

        $('[name=password]').focusout(function () {
            $(this).closest('.form-group').removeClass('hover-input-popup');
        });

        @endif
    })(jQuery);
</script>
@endpush
